## UBS Platform v3

This project contains the **UBS Platform v3**, a small WordPress-based system for books and chapters with social features and monetization. It is organized as two separate plugins that can be used together:

- `ubs-core` – base functionality (post types, taxonomies, meta, following, notifications, dashboard).
- `ubs-monetization` – paid access, paywall, tokens, Stripe link, and simple ads.

You can keep them together in one repository or split each plugin into its **own GitHub repository**.

**License**: [GNU GPL v2 or later](LICENSE)

> 📖 **For detailed installation instructions**, see [INSTALLATION_GUIDE.md](INSTALLATION_GUIDE.md) - includes complete plugin analysis, GitHub setup, and WordPress installation steps.

### Project layout

```text
ubs-platform v3/
  plugins/
    ubs-core/
      ubs-core.php
      README.md
      ...
    ubs-monetization/
      ubs-monetization.php
      README.md
      ...
```

Each plugin directory already has its own `README.md` explaining:

- Features.
- Folder structure.
- How to zip and upload to WordPress.
- How to initialize and push as a standalone GitHub repository.

### Using as a single repository

If you want this **whole folder** to be one repo (for example `ubs-platform`):

1. Open `ubs-platform v3` in a terminal.
2. Run:

```bash
git init
git add .
git commit -m "Initial commit: UBS Platform v3"
git branch -M main
git remote add origin <your-repo-url>
git push -u origin main
```

You can then manage both plugins together, while the `plugins/ubs-core` and `plugins/ubs-monetization` subfolders stay clean and self-contained.

### Splitting into two repositories

If you prefer one repository per plugin:

1. Create a new empty folder for each plugin (for example somewhere outside this project):
   - `ubs-core`
   - `ubs-monetization`
2. Copy the contents of:
   - `plugins/ubs-core/` → into your new `ubs-core/` folder.
   - `plugins/ubs-monetization/` → into your new `ubs-monetization/` folder.
3. In each new folder, run the Git commands shown in each plugin’s `README.md` to initialize and push to its own GitHub repo.

### WordPress usage summary

- Install and activate **UBS Core** first (`ubs-core`).
- Then install and activate **UBS Monetization** (`ubs-monetization`), which depends on Core.

After that you can:

- Create `ubs_book` and `ubs_chapter` content types.
- Use `[ubs_follow_button]` and `[ubs_author_dashboard]` shortcodes.
- Mark chapters as paid/both and use the monetization features.

### Quick Links

- 📚 **[Complete Installation Guide](INSTALLATION_GUIDE.md)** - Step-by-step instructions for GitHub and WordPress
- 🔍 **[UBS Core README](plugins/ubs-core/README.md)** - Core plugin documentation
- 💰 **[UBS Monetization README](plugins/ubs-monetization/README.md)** - Monetization plugin documentation
- 📄 **[License](LICENSE)** - GNU GPL v2 or later

