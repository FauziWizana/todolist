<?php
header('Content-Type: application/json');
require_once 'config.php';

$action = isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : '');

$conn = getDBConnection();

switch($action) {
    case 'get_all':
        getTasks($conn);
        break;
    
    case 'get_filtered':
        $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
        getFilteredTasks($conn, $filter);
        break;
    
    case 'add':
        addTask($conn);
        break;
    
    case 'toggle':
        toggleTask($conn);
        break;
    
    case 'update':
        updateTask($conn);
        break;
    
    case 'delete':
        deleteTask($conn);
        break;
    
    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
        break;
}

$conn->close();

// Get all tasks
function getTasks($conn) {
    $sql = "SELECT * FROM tasks ORDER BY created_at DESC";
    $result = $conn->query($sql);
    
    $tasks = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tasks[] = [
                'id' => $row['id'],
                'task_text' => $row['task_text'],
                'is_completed' => (bool)$row['is_completed'],
                'created_at' => $row['created_at']
            ];
        }
    }
    
    echo json_encode(['success' => true, 'tasks' => $tasks]);
}

// Get filtered tasks
function getFilteredTasks($conn, $filter) {
    $sql = "SELECT * FROM tasks";
    
    if ($filter === 'active') {
        $sql .= " WHERE is_completed = 0";
    } elseif ($filter === 'completed') {
        $sql .= " WHERE is_completed = 1";
    }
    
    $sql .= " ORDER BY created_at DESC";
    
    $result = $conn->query($sql);
    
    $tasks = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $tasks[] = [
                'id' => $row['id'],
                'task_text' => $row['task_text'],
                'is_completed' => (bool)$row['is_completed'],
                'created_at' => $row['created_at']
            ];
        }
    }
    
    echo json_encode(['success' => true, 'tasks' => $tasks]);
}

// Add a new task
function addTask($conn) {
    $task_text = isset($_POST['task_text']) ? trim($_POST['task_text']) : '';
    
    if (empty($task_text)) {
        echo json_encode(['success' => false, 'error' => 'Task text cannot be empty']);
        return;
    }
    
    $task_text = $conn->real_escape_string($task_text);
    $sql = "INSERT INTO tasks (task_text) VALUES ('$task_text')";
    
    if ($conn->query($sql)) {
        echo json_encode([
            'success' => true,
            'task' => [
                'id' => $conn->insert_id,
                'task_text' => $task_text,
                'is_completed' => false
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error adding task: ' . $conn->error]);
    }
}

// Toggle task completion status
function toggleTask($conn) {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    if ($id <= 0) {
        echo json_encode(['success' => false, 'error' => 'Invalid task ID']);
        return;
    }
    
    $sql = "UPDATE tasks SET is_completed = NOT is_completed WHERE id = $id";
    
    if ($conn->query($sql)) {
        // Get updated task
        $result = $conn->query("SELECT * FROM tasks WHERE id = $id");
        $task = $result->fetch_assoc();
        
        echo json_encode([
            'success' => true,
            'task' => [
                'id' => $task['id'],
                'task_text' => $task['task_text'],
                'is_completed' => (bool)$task['is_completed']
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error toggling task: ' . $conn->error]);
    }
}

// Update task text
function updateTask($conn) {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $task_text = isset($_POST['task_text']) ? trim($_POST['task_text']) : '';
    
    if ($id <= 0) {
        echo json_encode(['success' => false, 'error' => 'Invalid task ID']);
        return;
    }
    
    if (empty($task_text)) {
        echo json_encode(['success' => false, 'error' => 'Task text cannot be empty']);
        return;
    }
    
    $task_text = $conn->real_escape_string($task_text);
    $sql = "UPDATE tasks SET task_text = '$task_text' WHERE id = $id";
    
    if ($conn->query($sql)) {
        echo json_encode([
            'success' => true,
            'task' => [
                'id' => $id,
                'task_text' => $task_text
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error updating task: ' . $conn->error]);
    }
}

// Delete a task
function deleteTask($conn) {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    if ($id <= 0) {
        echo json_encode(['success' => false, 'error' => 'Invalid task ID']);
        return;
    }
    
    $sql = "DELETE FROM tasks WHERE id = $id";
    
    if ($conn->query($sql)) {
        echo json_encode(['success' => true, 'id' => $id]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Error deleting task: ' . $conn->error]);
    }
}
?>
