# Staging Site Inventory — baseline

Recorded from https://staging.uberrito.com on **2026-07-15** (via wp-admin).

## Summary

The staging site is a **fresh, stock WordPress install**. There is no custom
theme, plugin, or content yet — this repo starts from a clean slate.

## Core

| Item | Value |
|---|---|
| WordPress version | 7.0.1 |
| Site title | "WordPress" (default, not yet configured) |
| Front page | Latest posts (default; only the stock "Sample Page" exists) |
| REST API | Enabled, application-passwords auth available |

## Themes

| Theme | Status |
|---|---|
| Twenty Twenty-Five | **Active** |
| Twenty Twenty-Four | Installed |
| Twenty Twenty-Three | Installed |

All are stock WordPress themes (not tracked in git).

## Plugins

| Plugin | Version | Status |
|---|---|---|
| LiteSpeed Cache | 7.8.1 | **Active** |
| Akismet Anti-spam | 5.7 | Inactive |
| Hello Dolly | 1.7.2 | Inactive |

All are stock/third-party plugins (not tracked in git).

## Hosting notes

- Server enforces rate limiting on `wp-login.php` (returns HTTP 429 on rapid
  attempts; server banner "hws").
- LiteSpeed server (implied by LiteSpeed Cache being pre-installed).

## Next steps

- [ ] Decide theme approach: custom block theme vs. child theme vs. page builder.
- [ ] Configure site basics on staging (title, permalinks, front page).
- [ ] Scaffold the custom theme in `wp-content/themes/` and commit it here.
- [ ] Set up a deploy path from this repo to staging (e.g. GitHub Action over SFTP/SSH once server credentials are available).
