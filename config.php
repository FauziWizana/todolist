<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'todolist_db');

// Create connection
function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
    
    // Check connection
    if ($conn->connect_error) {
        die(json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]));
    }
    
    // Create database if it doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
    if (!$conn->query($sql)) {
        die(json_encode(['success' => false, 'error' => 'Error creating database: ' . $conn->error]));
    }
    
    // Select the database
    $conn->select_db(DB_NAME);
    
    return $conn;
}

// Create tasks table if it doesn't exist
function initializeDatabase() {
    $conn = getDBConnection();
    
    $sql = "CREATE TABLE IF NOT EXISTS tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        task_text VARCHAR(255) NOT NULL,
        is_completed BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($sql)) {
        die(json_encode(['success' => false, 'error' => 'Error creating table: ' . $conn->error]));
    }
    
    $conn->close();
}

// Initialize database on first load
initializeDatabase();
?>
