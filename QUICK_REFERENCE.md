# UBS Platform v3 - Quick Reference Guide

## 🚀 Quick Installation Commands

### Upload to GitHub (Single Repository)
```bash
cd "e:\gremsa php website file\plugin hanaram\ubs-platform v3"
git init
git add .
git commit -m "Initial commit: UBS Platform v3"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git
git push -u origin main
```

### Create WordPress ZIP Files
```powershell
# For UBS Core
cd "plugins\ubs-core"
Compress-Archive -Path * -DestinationPath ..\..\ubs-core.zip

# For UBS Monetization
cd "plugins\ubs-monetization"
Compress-Archive -Path * -DestinationPath ..\..\ubs-monetization.zip
```

---

## 📋 Plugin Information

### UBS Core
- **Version**: 1.0.0
- **Main File**: `plugins/ubs-core/ubs-core.php`
- **Dependencies**: None
- **Database Tables**: `wp_ubs_followers`, `wp_ubs_notifications`

### UBS Monetization
- **Version**: 1.0.0
- **Main File**: `plugins/ubs-monetization/ubs-monetization.php`
- **Dependencies**: Requires UBS Core
- **Database Tables**: None (uses user meta)

---

## 🎯 Shortcodes

### Follow Button
```
[ubs_follow_button]
[ubs_follow_button author="1"]
```

### Author Dashboard
```
[ubs_author_dashboard]
```

---

## 🔑 Access Types

| Type | Description |
|------|-------------|
| `public` | Everyone can read |
| `followers` | Only followers can read |
| `paid` | Requires payment/unlock |
| `both` | Followers OR paying users can read |

---

## 📊 Custom Post Types

| Post Type | Slug | Archive |
|-----------|------|---------|
| `ubs_book` | `/books` | Yes |
| `ubs_chapter` | `/chapter` | No |

---

## 🗂️ Taxonomy

- **Name**: `ubs_book_category`
- **Type**: Hierarchical
- **Post Type**: `ubs_book`

---

## 💾 Meta Fields

### Chapter Meta
- `_ubs_is_premium` (boolean) - Marks chapter as premium
- `_ubs_access_type` (string) - Access control type

### User Meta (Monetization)
- `_ubs_stripe_link` (string) - Stripe payment link URL
- `_ubs_token_{chapter_id}` (string) - Access token for chapter

---

## 🔗 Token-Based Unlock URL Format

```
https://yoursite.com/chapter/chapter-slug/?ubs_unlock=<token>&chapter=<chapter_id>
```

---

## 🛠️ PHP Functions

### Generate Access Token
```php
$token_manager = new UBS_Token_Manager();
$token = $token_manager->generate_token($user_id, $chapter_id);
```

### Check Paid Access
```php
$has_access = apply_filters('ubs_user_has_paid_access', false, $user_id, $chapter_id);
```

---

## 📁 Key File Locations

### Core Plugin
- Loader: `plugins/ubs-core/includes/class-loader.php`
- Activator: `plugins/ubs-core/includes/class-activator.php`
- Post Types: `plugins/ubs-core/includes/core/class-post-types.php`
- Follow System: `plugins/ubs-core/includes/social/class-follow-system.php`
- JavaScript: `plugins/ubs-core/assets/js/follow.js`

### Monetization Plugin
- Loader: `plugins/ubs-monetization/includes/class-loader.php`
- Paid Access: `plugins/ubs-monetization/includes/core/class-paid-access.php`
- Token Manager: `plugins/ubs-monetization/includes/payments/class-token-manager.php`
- Paywall: `plugins/ubs-monetization/includes/core/class-paywall-template.php`

---

## ⚙️ WordPress Admin Locations

- **Books**: `/wp-admin/edit.php?post_type=ubs_book`
- **Chapters**: `/wp-admin/edit.php?post_type=ubs_chapter`
- **Book Categories**: `/wp-admin/edit-tags.php?taxonomy=ubs_book_category&post_type=ubs_book`
- **Notifications**: `/wp-admin/admin.php?page=ubs-notifications`

---

## 🔍 Troubleshooting Quick Fixes

| Issue | Quick Fix |
|-------|-----------|
| Post types not showing | Go to Settings → Permalinks → Save Changes |
| Monetization error | Ensure UBS Core is activated first |
| Follow button not working | Check browser console for JS errors |
| Database tables missing | Deactivate and reactivate UBS Core |

---

## 📝 Installation Order

1. ✅ Install UBS Core
2. ✅ Activate UBS Core
3. ✅ Install UBS Monetization
4. ✅ Activate UBS Monetization
5. ✅ Flush permalinks (Settings → Permalinks → Save)

---

## 🔐 Security Notes

- All files check `ABSPATH` before execution
- AJAX requests use nonce verification
- SQL uses prepared statements (dbDelta)
- User input is sanitized

---

## 📞 Support Resources

- **Full Guide**: [INSTALLATION_GUIDE.md](INSTALLATION_GUIDE.md)
- **Core README**: [plugins/ubs-core/README.md](plugins/ubs-core/README.md)
- **Monetization README**: [plugins/ubs-monetization/README.md](plugins/ubs-monetization/README.md)

---

**Last Updated**: Based on UBS Platform v3 (v1.0.0)
