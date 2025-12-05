# 🚀 Quick Start Guide

## Prerequisites Setup

Your system needs PHP and MySQL to run this application. Follow these steps:

### Step 1: Install Homebrew (if not already installed)

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

### Step 2: Install PHP

```bash
brew install php
```

Verify installation:
```bash
php --version
```

### Step 3: Install MySQL

```bash
brew install mysql
```

Start MySQL:
```bash
brew services start mysql
```

Verify MySQL is running:
```bash
mysql -u root
```

Type `exit` to leave MySQL prompt.

### Step 4: Secure MySQL (Optional but Recommended)

```bash
mysql_secure_installation
```

Follow the prompts. If you set a password, update `config.php` with your password.

## Running the Application

### Method 1: Using the Start Script (Recommended)

```bash
cd /Users/mekari/fauzi/todolist
./start.sh
```

### Method 2: Manual Start

```bash
cd /Users/mekari/fauzi/todolist
php -S localhost:8000
```

Then open your browser and go to: **http://localhost:8000**

## First Time Setup

1. **The application will automatically:**
   - Create the database `todolist_db`
   - Create the `tasks` table
   - Set up the necessary structure

2. **You can start using it immediately!**
   - Add your first task
   - Toggle completion
   - Edit and delete tasks
   - Use filters to organize your view

## Alternative: Using MAMP (If you prefer a GUI)

1. **Download and install MAMP:**
   - Visit: https://www.mamp.info/en/downloads/
   - Download MAMP (free version)

2. **Move the project:**
   ```bash
   cp -r /Users/mekari/fauzi/todolist /Applications/MAMP/htdocs/
   ```

3. **Start MAMP and click "Start Servers"**

4. **Open browser:**
   - Go to: http://localhost:8888/todolist
   - Or: http://localhost/todolist (depends on MAMP configuration)

## Troubleshooting

### PHP Not Found
```bash
# Install PHP
brew install php

# Add to PATH (add to ~/.zshrc)
export PATH="/usr/local/opt/php/bin:$PATH"

# Reload shell
source ~/.zshrc
```

### MySQL Not Running
```bash
# Start MySQL
brew services start mysql

# Or manually
mysql.server start

# Check status
brew services list | grep mysql
```

### Port 8000 Already in Use
```bash
# Use a different port
php -S localhost:3000

# Then access: http://localhost:3000
```

### Database Connection Error
1. Check if MySQL is running:
   ```bash
   mysql -u root
   ```

2. If you set a MySQL password, update `config.php`:
   ```php
   define('DB_PASS', 'your_password_here');
   ```

## Testing the Application

1. **Start the server**
2. **Open http://localhost:8000**
3. **Try these actions:**
   - Add a task: "Buy groceries"
   - Mark it as complete
   - Edit the task
   - Add more tasks
   - Use filters (All/Active/Completed)
   - Delete a task

## Stopping the Server

- Press `Ctrl + C` in the terminal where PHP server is running

## Need Help?

Check the main README.md for detailed documentation and troubleshooting.

---

**Happy Task Managing! 📝✨**
