<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Todo List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>📝 My Todo List</h1>
            <p class="subtitle">Stay organized and productive</p>
        </header>

        <!-- Input Section -->
        <div class="input-section">
            <input 
                type="text" 
                id="taskInput" 
                placeholder="What do you need to do today?"
                maxlength="255"
            >
            <button id="addBtn" class="btn btn-primary">
                <span>Add Task</span>
            </button>
        </div>

        <!-- Stats Section -->
        <div class="stats-section">
            <div class="stat">
                <span class="stat-value" id="totalTasks">0</span>
                <span class="stat-label">Total</span>
            </div>
            <div class="stat">
                <span class="stat-value" id="activeTasks">0</span>
                <span class="stat-label">Active</span>
            </div>
            <div class="stat">
                <span class="stat-value" id="completedTasks">0</span>
                <span class="stat-label">Completed</span>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="active">Active</button>
            <button class="filter-btn" data-filter="completed">Completed</button>
        </div>

        <!-- Task List Section -->
        <div class="task-list-section">
            <div id="emptyState" class="empty-state">
                <div class="empty-icon">📋</div>
                <p>No tasks yet. Add one to get started!</p>
            </div>
            <ul id="taskList" class="task-list"></ul>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast"></div>

    <script src="script.js"></script>
</body>
</html>
