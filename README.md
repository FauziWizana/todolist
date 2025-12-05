# 📝 Todo List Web Application

A simple, elegant Todo List web application built with HTML, CSS, JavaScript, and PHP with MySQL database for persistent storage.

## ✨ Features

- ✅ **Add Tasks** - Create new tasks with a simple input field
- 📋 **View Tasks** - Display all tasks in a clean, organized list
- ✓ **Toggle Completion** - Mark tasks as complete/incomplete with a checkbox
- ✏️ **Edit Tasks** - Modify task text with inline editing
- 🗑️ **Delete Tasks** - Remove tasks with confirmation
- 🔍 **Filter Tasks** - View All, Active, or Completed tasks
- 📊 **Statistics** - Real-time count of total, active, and completed tasks
- 💾 **Persistent Storage** - All tasks saved in MySQL database
- 📱 **Responsive Design** - Works on desktop and mobile devices

## 🛠️ Requirements

- **PHP** 7.4 or higher
- **MySQL** 5.7 or higher (or MariaDB)
- **Web Server** (Apache, Nginx, or PHP built-in server)
- **Web Browser** (Chrome, Firefox, Safari, or Edge)

## 📦 Installation

### 1. Clone or Download the Project

```bash
cd /Users/mekari/fauzi/todolist
```

### 2. Set Up MySQL Database

The application will automatically create the database and table on first run, but you need to have MySQL running.

**Option A: Using MySQL (Recommended)**

1. Start MySQL server:
   ```bash
   # On macOS with Homebrew
   brew services start mysql
   
   # Or manually
   mysql.server start
   ```

2. Verify MySQL is running:
   ```bash
   mysql -u root -p
   ```

3. The application uses these default credentials:
   - Host: `localhost`
   - Username: `root`
   - Password: `` (empty)
   - Database: `todolist_db` (will be created automatically)

**Option B: Customize Database Credentials**

If your MySQL setup uses different credentials, edit `config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'todolist_db');
```

### 3. Start the Application

**Using PHP Built-in Server (Easiest Method):**

```bash
cd /Users/mekari/fauzi/todolist
php -S localhost:8000
```

The application will be available at: **http://localhost:8000**

**Using XAMPP/MAMP:**

1. Move the project folder to your web server directory:
   - XAMPP: `/Applications/XAMPP/htdocs/todolist`
   - MAMP: `/Applications/MAMP/htdocs/todolist`

2. Access via: **http://localhost/todolist** or **http://localhost:8888/todolist** (MAMP)

## 🚀 Usage

1. **Add a Task**
   - Type your task in the input field
   - Click "Add Task" or press Enter
   - Task appears in the list

2. **Complete a Task**
   - Click the checkbox next to the task
   - Task text will be crossed out

3. **Edit a Task**
   - Click the "Edit" button
   - Modify the text
   - Click "Save" or press Enter

4. **Delete a Task**
   - Click the "Delete" button
   - Confirm deletion

5. **Filter Tasks**
   - Click "All" to see all tasks
   - Click "Active" to see incomplete tasks
   - Click "Completed" to see finished tasks

## 📁 Project Structure

```
todolist/
├── index.php          # Main HTML interface
├── api.php            # Backend API for CRUD operations
├── config.php         # Database configuration and connection
├── style.css          # Styling and responsive design
├── script.js          # Frontend JavaScript logic
└── README.md          # This file
```

## 🗄️ Database Schema

```sql
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_text VARCHAR(255) NOT NULL,
    is_completed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## 🔧 API Endpoints

All API calls are made to `api.php`:

- `GET api.php?action=get_all` - Get all tasks
- `GET api.php?action=get_filtered&filter={all|active|completed}` - Get filtered tasks
- `POST api.php` with `action=add&task_text={text}` - Add new task
- `POST api.php` with `action=toggle&id={id}` - Toggle task completion
- `POST api.php` with `action=update&id={id}&task_text={text}` - Update task
- `POST api.php` with `action=delete&id={id}` - Delete task

## 🎨 Customization

### Change Colors

Edit the CSS variables in `style.css`:

```css
:root {
    --primary-color: #6366f1;
    --success-color: #10b981;
    --danger-color: #ef4444;
    /* ... more colors */
}
```

### Change Port

When using PHP built-in server:

```bash
php -S localhost:3000  # Use port 3000 instead
```

## 🐛 Troubleshooting

**Problem: "Connection failed" error**
- Make sure MySQL is running
- Verify database credentials in `config.php`
- Check MySQL service: `mysql.server status`

**Problem: Page doesn't load**
- Ensure PHP is installed: `php --version`
- Check if port 8000 is available
- Try a different port: `php -S localhost:3000`

**Problem: Tasks not saving**
- Check browser console for JavaScript errors
- Verify `api.php` is accessible
- Check MySQL error logs

**Problem: Styles not loading**
- Clear browser cache
- Check if `style.css` is in the same directory
- Verify file permissions

## 📝 License

This project is free to use and modify for personal and commercial purposes.

## 🤝 Contributing

Feel free to fork, modify, and improve this project!

## 📧 Support

For issues or questions, please check the troubleshooting section above.

---

**Enjoy organizing your tasks! 📋✨**
