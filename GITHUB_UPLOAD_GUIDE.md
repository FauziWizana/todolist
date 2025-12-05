# 📤 Upload Project to GitHub - Step by Step Guide

## Prerequisites

1. **GitHub Account**: Create one at https://github.com if you don't have it
2. **Git Installed**: Check by running `git --version` in terminal

### Install Git (if not installed)
```bash
brew install git
```

---

## 🚀 Method 1: Using GitHub Website + Terminal (Recommended)

### Step 1: Create Repository on GitHub

1. Go to **https://github.com**
2. Click the **"+"** button (top right) → **"New repository"**
3. Fill in the details:
   - **Repository name**: `todolist` (or any name you prefer)
   - **Description**: `A simple Todo List web application with PHP and MySQL`
   - **Visibility**: Choose **Public** or **Private**
   - **DO NOT** check "Initialize with README" (we already have one)
4. Click **"Create repository"**

### Step 2: Initialize Git in Your Project

Open terminal and run these commands:

```bash
# Navigate to your project
cd /Users/mekari/fauzi/todolist

# Initialize git repository
git init

# Add all files to staging
git add .

# Create first commit
git commit -m "Initial commit: Todo List application"
```

### Step 3: Connect to GitHub and Push

Replace `YOUR_USERNAME` with your actual GitHub username:

```bash
# Add remote repository
git remote add origin https://github.com/YOUR_USERNAME/todolist.git

# Rename branch to main (GitHub's default)
git branch -M main

# Push to GitHub
git push -u origin main
```

**Enter your GitHub credentials when prompted.**

### Step 4: Verify Upload

1. Go to your GitHub repository: `https://github.com/YOUR_USERNAME/todolist`
2. You should see all your files!

---

## 🔐 Method 2: Using Personal Access Token (More Secure)

If password authentication doesn't work, use a Personal Access Token:

### Step 1: Create Personal Access Token

1. Go to **GitHub** → **Settings** (your profile)
2. Scroll down → **Developer settings** → **Personal access tokens** → **Tokens (classic)**
3. Click **"Generate new token"** → **"Generate new token (classic)"**
4. Give it a name: `todolist-upload`
5. Select scope: **☑️ repo** (full control)
6. Click **"Generate token"**
7. **COPY THE TOKEN** (you won't see it again!)

### Step 2: Use Token for Push

```bash
# When pushing, use token instead of password
git push -u origin main

# Username: YOUR_GITHUB_USERNAME
# Password: PASTE_YOUR_TOKEN_HERE
```

---

## 🎯 Method 3: Using SSH (Advanced, No Password Needed)

### Step 1: Generate SSH Key

```bash
# Generate SSH key
ssh-keygen -t ed25519 -C "your_email@example.com"

# Press Enter to accept default location
# Press Enter for no passphrase (or create one)

# Copy SSH key to clipboard
pbcopy < ~/.ssh/id_ed25519.pub
```

### Step 2: Add SSH Key to GitHub

1. Go to **GitHub** → **Settings** → **SSH and GPG keys**
2. Click **"New SSH key"**
3. Title: `MacBook Pro` (or any name)
4. Paste the key (already in clipboard)
5. Click **"Add SSH key"**

### Step 3: Push Using SSH

```bash
cd /Users/mekari/fauzi/todolist
git init
git add .
git commit -m "Initial commit: Todo List application"

# Use SSH URL instead of HTTPS
git remote add origin git@github.com:YOUR_USERNAME/todolist.git
git branch -M main
git push -u origin main
```

---

## 📝 Quick Command Reference

### For First Time Upload:
```bash
cd /Users/mekari/fauzi/todolist
git init
git add .
git commit -m "Initial commit: Todo List application"
git remote add origin https://github.com/YOUR_USERNAME/todolist.git
git branch -M main
git push -u origin main
```

### For Future Updates:
```bash
cd /Users/mekari/fauzi/todolist
git add .
git commit -m "Description of your changes"
git push
```

---

## 🔧 Troubleshooting

### Problem: "git: command not found"
```bash
# Install git
brew install git

# Verify installation
git --version
```

### Problem: "Permission denied (publickey)"
- Use HTTPS method instead of SSH
- Or follow SSH setup steps above

### Problem: "Remote origin already exists"
```bash
# Remove existing remote and add new one
git remote remove origin
git remote add origin https://github.com/YOUR_USERNAME/todolist.git
```

### Problem: "Updates were rejected"
```bash
# Force push (only for new repository)
git push -u origin main --force
```

### Problem: Authentication failed
- Use Personal Access Token instead of password
- Follow Method 2 above

---

## 📋 What Gets Uploaded

✅ All PHP files (index.php, api.php, config.php)
✅ Frontend files (style.css, script.js)
✅ Documentation (README.md, SETUP.md, etc.)
✅ Helper scripts (start.sh)

❌ Not uploaded: Files in .gitignore (.DS_Store, IDE settings, etc.)

---

## 🎨 Customize Your Repository

### Add Topics/Tags
1. Go to your repository on GitHub
2. Click **"⚙️ Settings"** or the gear icon next to "About"
3. Add topics: `php`, `mysql`, `todolist`, `crud`, `javascript`, `css`, `html`

### Add Repository Description
Edit the description at the top of your repository page.

### Enable GitHub Pages (Optional)
⚠️ Note: This won't work directly as it needs PHP backend

---

## 🔄 Making Updates After Initial Upload

When you make changes to your project:

```bash
# 1. Check what changed
git status

# 2. Add all changes
git add .

# 3. Commit with message
git commit -m "Added new feature: task priority"

# 4. Push to GitHub
git push
```

---

## ✅ Verification Checklist

- [ ] Repository created on GitHub
- [ ] Git initialized locally
- [ ] Files added and committed
- [ ] Remote origin connected
- [ ] Successfully pushed to main branch
- [ ] All files visible on GitHub
- [ ] README.md displays properly

---

## 📞 Need Help?

- **GitHub Docs**: https://docs.github.com/en/get-started
- **Git Documentation**: https://git-scm.com/doc

---

**Ready to share your project with the world! 🚀**
