// DOM Elements
const taskInput = document.getElementById('taskInput');
const addBtn = document.getElementById('addBtn');
const taskList = document.getElementById('taskList');
const emptyState = document.getElementById('emptyState');
const filterBtns = document.querySelectorAll('.filter-btn');
const totalTasksEl = document.getElementById('totalTasks');
const activeTasksEl = document.getElementById('activeTasks');
const completedTasksEl = document.getElementById('completedTasks');
const toast = document.getElementById('toast');

// State
let currentFilter = 'all';
let allTasks = [];

// Initialize app
document.addEventListener('DOMContentLoaded', () => {
    loadTasks();
    
    // Event Listeners
    addBtn.addEventListener('click', addTask);
    taskInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') addTask();
    });
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            filterBtns.forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');
            currentFilter = e.target.dataset.filter;
            loadTasks();
        });
    });
});

// Load tasks from server
async function loadTasks() {
    try {
        const response = await fetch(`api.php?action=get_filtered&filter=${currentFilter}`);
        const data = await response.json();
        
        if (data.success) {
            allTasks = data.tasks;
            renderTasks(data.tasks);
            updateStats();
        } else {
            showToast('Error loading tasks', 'error');
        }
    } catch (error) {
        showToast('Network error', 'error');
        console.error('Error:', error);
    }
}

// Render tasks in the UI
function renderTasks(tasks) {
    taskList.innerHTML = '';
    
    if (tasks.length === 0) {
        emptyState.classList.remove('hidden');
        taskList.style.display = 'none';
    } else {
        emptyState.classList.add('hidden');
        taskList.style.display = 'block';
        
        tasks.forEach(task => {
            const taskItem = createTaskElement(task);
            taskList.appendChild(taskItem);
        });
    }
}

// Create task element
function createTaskElement(task) {
    const li = document.createElement('li');
    li.className = `task-item ${task.is_completed ? 'completed' : ''}`;
    li.dataset.id = task.id;
    
    li.innerHTML = `
        <input 
            type="checkbox" 
            class="task-checkbox" 
            ${task.is_completed ? 'checked' : ''}
            onchange="toggleTask(${task.id})"
        >
        <div class="task-content">
            <span class="task-text">${escapeHtml(task.task_text)}</span>
        </div>
        <div class="task-actions">
            <button class="task-btn edit-btn" onclick="editTask(${task.id})">Edit</button>
            <button class="task-btn delete-btn" onclick="deleteTask(${task.id})">Delete</button>
        </div>
    `;
    
    return li;
}

// Add new task
async function addTask() {
    const taskText = taskInput.value.trim();
    
    if (!taskText) {
        showToast('Please enter a task', 'error');
        return;
    }
    
    try {
        const formData = new FormData();
        formData.append('action', 'add');
        formData.append('task_text', taskText);
        
        const response = await fetch('api.php', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            taskInput.value = '';
            loadTasks();
            showToast('Task added successfully', 'success');
        } else {
            showToast(data.error || 'Error adding task', 'error');
        }
    } catch (error) {
        showToast('Network error', 'error');
        console.error('Error:', error);
    }
}

// Toggle task completion
async function toggleTask(id) {
    try {
        const formData = new FormData();
        formData.append('action', 'toggle');
        formData.append('id', id);
        
        const response = await fetch('api.php', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            loadTasks();
            showToast('Task updated', 'success');
        } else {
            showToast(data.error || 'Error updating task', 'error');
        }
    } catch (error) {
        showToast('Network error', 'error');
        console.error('Error:', error);
    }
}

// Edit task
function editTask(id) {
    const taskItem = document.querySelector(`[data-id="${id}"]`);
    const taskContent = taskItem.querySelector('.task-content');
    const taskText = taskItem.querySelector('.task-text').textContent;
    const taskActions = taskItem.querySelector('.task-actions');
    
    // Replace content with input
    taskContent.innerHTML = `
        <input 
            type="text" 
            class="task-edit-input" 
            value="${escapeHtml(taskText)}"
            maxlength="255"
        >
    `;
    
    // Replace actions with save/cancel
    taskActions.innerHTML = `
        <button class="task-btn save-btn" onclick="saveTask(${id})">Save</button>
        <button class="task-btn cancel-btn" onclick="loadTasks()">Cancel</button>
    `;
    
    // Focus input
    const input = taskContent.querySelector('.task-edit-input');
    input.focus();
    input.select();
    
    // Allow Enter to save
    input.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') saveTask(id);
    });
}

// Save edited task
async function saveTask(id) {
    const taskItem = document.querySelector(`[data-id="${id}"]`);
    const input = taskItem.querySelector('.task-edit-input');
    const newText = input.value.trim();
    
    if (!newText) {
        showToast('Task text cannot be empty', 'error');
        return;
    }
    
    try {
        const formData = new FormData();
        formData.append('action', 'update');
        formData.append('id', id);
        formData.append('task_text', newText);
        
        const response = await fetch('api.php', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            loadTasks();
            showToast('Task updated successfully', 'success');
        } else {
            showToast(data.error || 'Error updating task', 'error');
        }
    } catch (error) {
        showToast('Network error', 'error');
        console.error('Error:', error);
    }
}

// Delete task
async function deleteTask(id) {
    if (!confirm('Are you sure you want to delete this task?')) {
        return;
    }
    
    try {
        const formData = new FormData();
        formData.append('action', 'delete');
        formData.append('id', id);
        
        const response = await fetch('api.php', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            loadTasks();
            showToast('Task deleted', 'success');
        } else {
            showToast(data.error || 'Error deleting task', 'error');
        }
    } catch (error) {
        showToast('Network error', 'error');
        console.error('Error:', error);
    }
}

// Update statistics
async function updateStats() {
    try {
        const response = await fetch('api.php?action=get_all');
        const data = await response.json();
        
        if (data.success) {
            const tasks = data.tasks;
            const total = tasks.length;
            const completed = tasks.filter(t => t.is_completed).length;
            const active = total - completed;
            
            totalTasksEl.textContent = total;
            activeTasksEl.textContent = active;
            completedTasksEl.textContent = completed;
        }
    } catch (error) {
        console.error('Error updating stats:', error);
    }
}

// Show toast notification
function showToast(message, type = 'success') {
    toast.textContent = message;
    toast.className = `toast ${type} show`;
    
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// Escape HTML to prevent XSS
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
