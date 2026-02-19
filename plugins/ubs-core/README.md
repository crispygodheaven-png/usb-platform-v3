## UBS Core

UBS Core is the **foundation plugin** for the Universal Book System platform. It provides custom post types, taxonomies, meta fields, author–reader social features, and basic access control that other plugins (such as UBS Monetization) can extend.

### Features

- **Custom post types**
  - `ubs_book` – represents a book.
  - `ubs_chapter` – represents a chapter belonging to a book.
- **Taxonomies**
  - `ubs_book_category` – hierarchical categories for books.
- **Meta fields**
  - `_ubs_is_premium` (`boolean`) – marks a chapter as premium.
  - `_ubs_access_type` (`string`) – access mode: `public`, `followers`, `paid`, or `both`.
- **Access control**
  - Filters chapter content and restricts based on login status and follower status.
- **Follow system**
  - Readers can follow authors using an AJAX‑powered “Follow” button.
  - Follower relationships stored in the `wp_ubs_followers` table.
- **Notifications**
  - When an author publishes a `ubs_chapter`, followers receive notifications stored in `wp_ubs_notifications`.
  - Admin page to view recent notifications.
- **Author dashboard**
  - Shortcode that shows follower count, chapter count, and Stripe link status (when Monetization is installed).

### Folder structure

```text
ubs-core/
  ubs-core.php
  README.md
  assets/
    js/
      follow.js
  includes/
    class-loader.php
    class-activator.php
    class-deactivator.php
    core/
      class-post-types.php
      class-taxonomies.php
      class-meta.php
      class-access-control.php
    social/
      class-follow-system.php
      class-follow-button.php
      class-notification-system.php
    admin/
      class-admin-notifications.php
    dashboard/
      class-author-dashboard.php
```

### Installation (as a WordPress plugin)

1. Create a folder named `ubs-core` and put all of this code inside it.
2. Zip the folder to `ubs-core.zip`.
3. In WordPress admin, go to **Plugins → Add New → Upload Plugin**.
4. Upload `ubs-core.zip`, install, and **Activate**.

On activation, the plugin will:

- Create the `wp_ubs_followers` and `wp_ubs_notifications` tables.
- Register post types, taxonomy, meta, and hooks.

### Usage

- **Author dashboard shortcode**
  - Add `[ubs_author_dashboard]` to a page to show the author dashboard for the currently logged‑in user.
- **Follow button shortcode**
  - Add `[ubs_follow_button]` inside a loop on an author’s content.
  - Optional attribute: `author` (author ID). If omitted, the post author is used.

Example:

```text
[ubs_follow_button]
```

### Using this folder as a standalone GitHub repository

1. Create a new GitHub repository (for example `ubs-core`).
2. On your computer, open the `ubs-core` folder in a terminal.
3. Initialize Git and push:

```bash
git init
git add .
git commit -m "Initial commit: UBS Core"
git branch -M main
git remote add origin <your-repo-url>
git push -u origin main
```

You can then tag releases (for example `v1.0.0`) and download the source as a ZIP from GitHub to install as a WordPress plugin.

