## UBS Monetization

UBS Monetization is an **addon plugin** for the Universal Book System platform. It depends on the UBS Core plugin and adds paid access, paywall rendering, token‑based unlocks, and basic ads.

### Requirements

- WordPress site with UBS Core active.
- PHP 7.4+ recommended.

If UBS Core is not active, this plugin will show an admin notice and stop loading.

### Features

- **Paid access for chapters**
  - Hooks into the `ubs_chapter` content.
  - Respects `_ubs_access_type` meta from Core:
    - `public` – no restriction.
    - `followers` – handled by UBS Core.
    - `paid` – requires payment/unlock.
    - `both` – followers or payers may access.
  - If a user does not have paid access, a paywall is rendered instead of the chapter content.
- **Paywall template**
  - Displays a message that the chapter is premium.
  - Optionally shows a “Purchase Access” button when a Stripe payment link is available for the author.
- **Token manager**
  - Generates and stores per‑user, per‑chapter tokens.
  - On valid token in the URL (via `?ubs_unlock=...&chapter=...`), it marks the user as having paid access for that request via the `ubs_user_has_paid_access` filter.
- **Stripe link per author**
  - Adds a **Stripe Payment Link** field to the user profile screen for authors.
  - Stores the link as `_ubs_stripe_link` user meta.
- **Ads manager**
  - Optionally injects simple placeholder ads before and after `ubs_book` and `ubs_chapter` content.

### Folder structure

```text
ubs-monetization/
  ubs-monetization.php
  README.md
  includes/
    class-loader.php
    core/
      class-paid-access.php
      class-paywall-template.php
    payments/
      class-token-manager.php
      class-stripe-link.php
    ads/
      class-ads-manager.php
```

### Installation (as a WordPress plugin)

1. Make sure the UBS Core plugin is installed and **active**.
2. Create a folder named `ubs-monetization` and put all of this code inside it.
3. Zip the folder to `ubs-monetization.zip`.
4. In WordPress admin, go to **Plugins → Add New → Upload Plugin**.
5. Upload `ubs-monetization.zip`, install, and **Activate**.

If UBS Core is not active, you’ll see an admin notice:  
“UBS Monetization requires UBS Core plugin active.”

### Usage

- **Mark chapters as paid**
  - Use the `_ubs_access_type` meta (for example via a custom metabox or REST API) and set to:
    - `paid` – only paying users with a valid token can read.
    - `both` – followers or paying users can read.
- **Provide Stripe link for authors**
  - Edit an author’s profile in wp‑admin.
  - Fill in the **Stripe Link** field with a Stripe payment URL.
  - When a chapter is restricted and the author has a Stripe link, the paywall shows a “Purchase Access” button linking to that URL.
- **Token‑based unlock**
  - After successful payment in your own flow, you can:
    - Use `UBS_Token_Manager::generate_token($user_id, $chapter_id)` to generate a token.
    - Redirect the user to the chapter URL with `?ubs_unlock=<token>&chapter=<chapter_id>` so the plugin grants access.

### Using this folder as a standalone GitHub repository

1. Create a new GitHub repository (for example `ubs-monetization`).
2. On your computer, open the `ubs-monetization` folder in a terminal.
3. Initialize Git and push:

```bash
git init
git add .
git commit -m "Initial commit: UBS Monetization"
git branch -M main
git remote add origin <your-repo-url>
git push -u origin main
```

You can then tag releases and download the source as a ZIP from GitHub to install as a WordPress plugin.

