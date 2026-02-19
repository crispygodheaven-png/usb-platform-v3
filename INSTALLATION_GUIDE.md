# UBS Platform v3 - Complete Installation Guide

## 📋 Table of Contents
1. [Plugin Analysis](#plugin-analysis)
2. [Installation to GitHub](#installation-to-github)
3. [Installation to WordPress](#installation-to-wordpress)
4. [Post-Installation Setup](#post-installation-setup)

---

## 🔍 Plugin Analysis

### Overview
**UBS Platform v3** is a WordPress-based content management system designed for books and chapters with social features and monetization capabilities. It consists of two interdependent plugins:

### Architecture

#### **1. UBS Core Plugin** (`plugins/ubs-core/`)
**Purpose**: Foundation plugin providing core functionality

**Key Components**:
- **Entry Point**: `ubs-core.php`
- **Version**: 1.0.0
- **Author**: crispy god
- **Text Domain**: ubs-core

**Features**:
- ✅ Custom Post Types:
  - `ubs_book` - Book content type (slug: `/books`)
  - `ubs_chapter` - Chapter content type (slug: `/chapter`)
- ✅ Taxonomy: `ubs_book_category` (hierarchical categories)
- ✅ Meta Fields:
  - `_ubs_is_premium` (boolean) - Marks chapter as premium
  - `_ubs_access_type` (string) - Access control: `public`, `followers`, `paid`, `both`
- ✅ Follow System:
  - AJAX-powered follow button (`[ubs_follow_button]` shortcode)
  - Stores relationships in `wp_ubs_followers` table
- ✅ Notification System:
  - Notifies followers when authors publish chapters
  - Stores in `wp_ubs_notifications` table
  - Admin page for viewing notifications
- ✅ Author Dashboard:
  - `[ubs_author_dashboard]` shortcode
  - Shows follower count, chapter count, Stripe link status
- ✅ Access Control:
  - Filters chapter content based on login and follower status

**Database Tables Created** (on activation):
- `wp_ubs_followers` - User-author follow relationships
- `wp_ubs_notifications` - User notifications

**File Structure**:
```
ubs-core/
├── ubs-core.php                    # Main plugin file
├── README.md                        # Plugin documentation
├── assets/
│   └── js/
│       └── follow.js               # AJAX follow functionality
└── includes/
    ├── class-loader.php            # Loads all dependencies
    ├── class-activator.php         # Creates database tables
    ├── class-deactivator.php       # Cleanup on deactivation
    ├── core/
    │   ├── class-post-types.php    # Registers ubs_book & ubs_chapter
    │   ├── class-taxonomies.php    # Registers ubs_book_category
    │   ├── class-meta.php          # Meta field registration
    │   └── class-access-control.php # Content access filtering
    ├── social/
    │   ├── class-follow-system.php # Follow/unfollow logic
    │   ├── class-follow-button.php # Shortcode & AJAX handler
    │   └── class-notification-system.php # Notification creation
    ├── admin/
    │   └── class-admin-notifications.php # Admin notifications page
    └── dashboard/
        └── class-author-dashboard.php # Author dashboard shortcode
```

**Dependencies**: None (standalone plugin)

---

#### **2. UBS Monetization Plugin** (`plugins/ubs-monetization/`)
**Purpose**: Adds monetization features (requires UBS Core)

**Key Components**:
- **Entry Point**: `ubs-monetization.php`
- **Version**: 1.0.0
- **Author**: UBS Platform
- **Dependency**: Requires `UBS_Core_Loader` class to be loaded

**Features**:
- ✅ Paid Access Control:
  - Hooks into `ubs_chapter` content
  - Respects `_ubs_access_type` meta
  - Shows paywall for restricted content
- ✅ Paywall Template:
  - Displays premium message
  - Shows "Purchase Access" button (if Stripe link available)
- ✅ Token Manager:
  - Generates per-user, per-chapter tokens
  - URL-based unlock: `?ubs_unlock=<token>&chapter=<id>`
  - Grants access via `ubs_user_has_paid_access` filter
- ✅ Stripe Integration:
  - Adds Stripe Payment Link field to user profiles
  - Stores as `_ubs_stripe_link` user meta
- ✅ Ads Manager:
  - Injects placeholder ads before/after book/chapter content

**File Structure**:
```
ubs-monetization/
├── ubs-monetization.php            # Main plugin file
├── README.md                        # Plugin documentation
└── includes/
    ├── class-loader.php            # Loads all dependencies
    ├── core/
    │   ├── class-paid-access.php   # Content filtering for paid chapters
    │   └── class-paywall-template.php # Paywall rendering
    ├── payments/
    │   ├── class-token-manager.php # Token generation & validation
    │   └── class-stripe-link.php   # Stripe link user meta
    └── ads/
        └── class-ads-manager.php   # Ad injection system
```

**Dependencies**: 
- ⚠️ **REQUIRES** UBS Core plugin to be active
- Shows admin notice if Core is not active

---

### Technical Specifications

**PHP Requirements**: PHP 7.4+ recommended

**WordPress Compatibility**: Standard WordPress installation

**Security Features**:
- ✅ ABSPATH checks on all files
- ✅ Nonce verification for AJAX requests
- ✅ Data sanitization and validation
- ✅ Prepared SQL statements (via dbDelta)

**Hooks & Filters**:
- `ubs_user_has_paid_access` - Filter to check paid access
- `the_content` - Filter for content restriction
- `init` - Action for token checking
- `admin_notices` - Action for dependency notices

---

## 🚀 Installation to GitHub

### Option 1: Single Repository (Recommended for Development)

This keeps both plugins together in one repository for easier management.

#### Step 1: Initialize Git Repository

1. **Open Terminal/PowerShell** in the project root:
   ```powershell
   cd "e:\gremsa php website file\plugin hanaram\ubs-platform v3"
   ```

2. **Initialize Git**:
   ```bash
   git init
   ```

3. **Check .gitignore** (already configured):
   - Excludes: `node_modules/`, `vendor/`, `.env`, `*.zip`, IDE files, etc.

#### Step 2: Create GitHub Repository

1. **Go to GitHub.com** and sign in
2. **Click** "New repository" (or go to https://github.com/new)
3. **Repository name**: `ubs-platform-v3` (or your preferred name)
4. **Description**: "WordPress plugin system for books and chapters with social features and monetization"
5. **Visibility**: Choose Public or Private
6. **DO NOT** initialize with README, .gitignore, or license (we already have these)
7. **Click** "Create repository"

#### Step 3: Connect and Push

1. **Add all files**:
   ```bash
   git add .
   ```

2. **Create initial commit**:
   ```bash
   git commit -m "Initial commit: UBS Platform v3"
   ```

3. **Rename branch to main** (if needed):
   ```bash
   git branch -M main
   ```

4. **Add remote repository** (replace `<your-username>` and `<repo-name>`):
   ```bash
   git remote add origin https://github.com/<your-username>/<repo-name>.git
   ```
   
   Example:
   ```bash
   git remote add origin https://github.com/yourusername/ubs-platform-v3.git
   ```

5. **Push to GitHub**:
   ```bash
   git push -u origin main
   ```

6. **Enter credentials** when prompted (GitHub username and Personal Access Token)

#### Step 4: Verify Upload

- Visit your repository on GitHub
- Confirm all files are present:
  - `plugins/ubs-core/` folder
  - `plugins/ubs-monetization/` folder
  - `README.md`
  - `.gitignore`

---

### Option 2: Two Separate Repositories

If you want each plugin in its own repository:

#### For UBS Core:

1. **Create new folder** outside the project:
   ```powershell
   cd "e:\gremsa php website file\plugin hanaram"
   mkdir ubs-core-standalone
   ```

2. **Copy UBS Core files**:
   ```powershell
   xcopy "ubs-platform v3\plugins\ubs-core\*" "ubs-core-standalone\" /E /I
   ```

3. **Navigate to new folder**:
   ```bash
   cd ubs-core-standalone
   ```

4. **Initialize Git**:
   ```bash
   git init
   git add .
   git commit -m "Initial commit: UBS Core"
   git branch -M main
   ```

5. **Create GitHub repo** named `ubs-core`

6. **Connect and push**:
   ```bash
   git remote add origin https://github.com/<your-username>/ubs-core.git
   git push -u origin main
   ```

#### For UBS Monetization:

1. **Create new folder**:
   ```powershell
   cd "e:\gremsa php website file\plugin hanaram"
   mkdir ubs-monetization-standalone
   ```

2. **Copy files**:
   ```powershell
   xcopy "ubs-platform v3\plugins\ubs-monetization\*" "ubs-monetization-standalone\" /E /I
   ```

3. **Initialize and push** (same steps as Core):
   ```bash
   cd ubs-monetization-standalone
   git init
   git add .
   git commit -m "Initial commit: UBS Monetization"
   git branch -M main
   git remote add origin https://github.com/<your-username>/ubs-monetization.git
   git push -u origin main
   ```

---

## 📦 Installation to WordPress

### Prerequisites

- ✅ WordPress installation (latest version recommended)
- ✅ PHP 7.4 or higher
- ✅ Admin access to WordPress dashboard
- ✅ FTP/File Manager access (if manual installation)

---

### Method 1: Upload via WordPress Admin (Recommended)

#### Step 1: Prepare Plugin Archives

**For UBS Core:**

1. **Navigate to plugin folder**:
   ```powershell
   cd "e:\gremsa php website file\plugin hanaram\ubs-platform v3\plugins\ubs-core"
   ```

2. **Select all files** in the `ubs-core` folder:
   - `ubs-core.php`
   - `README.md`
   - `assets/` folder
   - `includes/` folder

3. **Create ZIP archive**:
   - Right-click → "Send to" → "Compressed (zipped) folder"
   - Name it: `ubs-core.zip`
   - **IMPORTANT**: The ZIP should contain the `ubs-core` folder, not the files directly
   - Structure should be: `ubs-core.zip` → `ubs-core/` → (all files)

   **OR use PowerShell**:
   ```powershell
   Compress-Archive -Path * -DestinationPath ..\ubs-core.zip
   ```

**For UBS Monetization:**

1. **Navigate to plugin folder**:
   ```powershell
   cd "e:\gremsa php website file\plugin hanaram\ubs-platform v3\plugins\ubs-monetization"
   ```

2. **Create ZIP archive**:
   ```powershell
   Compress-Archive -Path * -DestinationPath ..\ubs-monetization.zip
   ```

#### Step 2: Install UBS Core Plugin

1. **Log in** to WordPress Admin Dashboard
2. **Navigate to**: Plugins → Add New
3. **Click**: "Upload Plugin" button (top of page)
4. **Click**: "Choose File" and select `ubs-core.zip`
5. **Click**: "Install Now"
6. **Wait** for installation to complete
7. **Click**: "Activate Plugin"
8. **Verify**: 
   - Go to Plugins page
   - UBS Core should show as "Active"
   - Check for any error messages

#### Step 3: Install UBS Monetization Plugin

1. **Navigate to**: Plugins → Add New
2. **Click**: "Upload Plugin"
3. **Click**: "Choose File" and select `ubs-monetization.zip`
4. **Click**: "Install Now"
5. **Click**: "Activate Plugin"
6. **Verify**:
   - Plugin shows as "Active"
   - No error notices appear
   - If UBS Core is not active, you'll see: "UBS Monetization requires UBS Core plugin active."

#### Step 4: Verify Installation

1. **Check Database Tables**:
   - Go to phpMyAdmin or database tool
   - Verify tables exist:
     - `wp_ubs_followers`
     - `wp_ubs_notifications`

2. **Check Post Types**:
   - Go to WordPress Admin
   - You should see "Books" and "Chapters" in the sidebar menu

3. **Test Permalinks**:
   - Go to Settings → Permalinks
   - Click "Save Changes" (this flushes rewrite rules)

---

### Method 2: Manual Installation via FTP/File Manager

#### Step 1: Upload Plugin Files

1. **Connect** to your WordPress site via FTP or cPanel File Manager
2. **Navigate to**: `/wp-content/plugins/`
3. **Upload** the entire `ubs-core` folder:
   - Upload: `plugins/ubs-core/` → `/wp-content/plugins/ubs-core/`
4. **Upload** the entire `ubs-monetization` folder:
   - Upload: `plugins/ubs-monetization/` → `/wp-content/plugins/ubs-monetization/`

#### Step 2: Set File Permissions

- **Folders**: 755
- **Files**: 644

#### Step 3: Activate Plugins

1. **Log in** to WordPress Admin
2. **Go to**: Plugins
3. **Find**: "UBS Core" → Click "Activate"
4. **Find**: "UBS Monetization" → Click "Activate"

---

### Method 3: Installation from GitHub

If you uploaded to GitHub:

1. **Download ZIP** from GitHub:
   - Go to your repository
   - Click "Code" → "Download ZIP"
   - Extract the ZIP file

2. **Extract plugins**:
   - Navigate to `plugins/ubs-core/` folder
   - Create ZIP of this folder → `ubs-core.zip`
   - Navigate to `plugins/ubs-monetization/` folder
   - Create ZIP of this folder → `ubs-monetization.zip`

3. **Follow Method 1** (Upload via WordPress Admin) starting from Step 2

---

## ⚙️ Post-Installation Setup

### 1. Configure Permalinks

1. Go to **Settings → Permalinks**
2. Click **"Save Changes"** (even if you don't change anything)
3. This ensures custom post type URLs work correctly

### 2. Create Your First Book

1. Go to **Books → Add New**
2. Enter book title and description
3. Set featured image (optional)
4. Choose author
5. Assign to category (optional)
6. **Publish**

### 3. Create Your First Chapter

1. Go to **Chapters → Add New**
2. Enter chapter title and content
3. **Link to book**: Use meta box to select parent book
4. **Set Access Type**:
   - `public` - Everyone can read
   - `followers` - Only followers can read
   - `paid` - Requires payment/unlock
   - `both` - Followers OR paying users can read
5. **Publish**

### 4. Set Up Stripe Links (For Authors)

1. Go to **Users → All Users**
2. **Edit** an author's profile
3. Scroll to **"Stripe Link"** field
4. Enter Stripe Payment Link URL
5. **Update User**

### 5. Use Shortcodes

**Follow Button**:
```
[ubs_follow_button]
```
or with specific author:
```
[ubs_follow_button author="1"]
```

**Author Dashboard**:
```
[ubs_author_dashboard]
```

Add these to pages, posts, or widgets.

### 6. Test Token-Based Unlock

1. **Generate token** (via your payment system):
   ```php
   $token = UBS_Token_Manager::generate_token($user_id, $chapter_id);
   ```

2. **Redirect user** to chapter with token:
   ```
   https://yoursite.com/chapter/chapter-slug/?ubs_unlock=<token>&chapter=<chapter_id>
   ```

3. **User gains access** to paid content

---

## 🔧 Troubleshooting

### Issue: "UBS Monetization requires UBS Core plugin active"

**Solution**: 
- Ensure UBS Core is installed and activated first
- Check that `UBS_Core_Loader` class exists
- Deactivate and reactivate both plugins

### Issue: Custom post types not showing

**Solution**:
- Go to Settings → Permalinks
- Click "Save Changes" to flush rewrite rules
- Clear any caching plugins

### Issue: Database tables not created

**Solution**:
- Deactivate UBS Core
- Reactivate UBS Core
- Check database manually if needed

### Issue: Follow button not working

**Solution**:
- Check browser console for JavaScript errors
- Verify jQuery is loaded
- Check AJAX URL is correct
- Verify nonce is valid

### Issue: Paywall not showing

**Solution**:
- Verify `_ubs_access_type` meta is set to `paid` or `both`
- Check user is logged in (if required)
- Verify token manager is working
- Check `ubs_user_has_paid_access` filter

---

## 📝 Additional Notes

### Version Information
- **UBS Core**: 1.0.0
- **UBS Monetization**: 1.0.0
- **Platform**: WordPress
- **PHP**: 7.4+

### Support & Updates
- Check GitHub repository for updates
- Review README.md files in each plugin folder
- Check WordPress admin notices for important messages

### Security Best Practices
- Keep WordPress and plugins updated
- Use strong passwords
- Regularly backup database
- Monitor user activity
- Review file permissions

---

## ✅ Installation Checklist

- [ ] UBS Core plugin installed
- [ ] UBS Core plugin activated
- [ ] Database tables created (`wp_ubs_followers`, `wp_ubs_notifications`)
- [ ] UBS Monetization plugin installed
- [ ] UBS Monetization plugin activated
- [ ] Permalinks flushed
- [ ] First book created
- [ ] First chapter created
- [ ] Shortcodes tested
- [ ] Stripe links configured (if using monetization)
- [ ] Token system tested (if using paid access)

---

**Congratulations!** Your UBS Platform v3 is now installed and ready to use. 🎉
