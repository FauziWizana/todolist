#!/bin/bash

# Todo List Application - Quick Start Script
# This script helps you start the application quickly

echo "🚀 Starting Todo List Application..."
echo ""

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed. Please install PHP first."
    echo "   Install via Homebrew: brew install php"
    exit 1
fi

echo "✅ PHP is installed: $(php -v | head -n 1)"
echo ""

# Check if MySQL is running
if ! command -v mysql &> /dev/null; then
    echo "⚠️  MySQL command not found."
    echo "   Please ensure MySQL is installed and running."
    echo "   Install via Homebrew: brew install mysql"
    echo "   Start MySQL: brew services start mysql"
    echo ""
else
    echo "✅ MySQL is installed"
    # Try to connect to MySQL
    if mysql -u root -e "SELECT 1" &> /dev/null; then
        echo "✅ MySQL is running and accessible"
    else
        echo "⚠️  Cannot connect to MySQL. Starting MySQL..."
        brew services start mysql 2>/dev/null || mysql.server start 2>/dev/null
        sleep 2
    fi
fi

echo ""
echo "📂 Starting PHP development server..."
echo "📍 Location: http://localhost:8000"
echo ""
echo "🎯 To access your Todo List, open: http://localhost:8000"
echo ""
echo "💡 Press Ctrl+C to stop the server"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

# Start PHP server
php -S localhost:8000
