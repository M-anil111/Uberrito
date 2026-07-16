# Staging Site Inventory — baseline

Recorded from https://staging.uberrito.com on **2026-07-15** (via wp-admin);
plugin stack installed **2026-07-16**.

## Summary

The staging site started as a fresh, stock WordPress install. The build
stack (Elementor + Elementor Pro, Rank Math SEO + Pro, Wordfence, Novamira)
has now been installed and activated — no custom theme/plugin code yet.

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
| Hello Elementor | **Active** (base theme for the Elementor Pro build) |
| Twenty Twenty-Five / -Four / -Three | Installed (stock) |

The homepage is built in Elementor Pro on Hello Elementor — see
[`HOMEPAGE-BUILD.md`](HOMEPAGE-BUILD.md).

## Plugins

| Plugin | Version | Status |
|---|---|---|
| LiteSpeed Cache | 7.8.1 | **Active** |
| Elementor | 3.33.2 | **Active** |
| Elementor Pro | 3.32.2 | **Active** |
| Rank Math SEO | (free, auto-installed as Pro dependency) | **Active** |
| Rank Math SEO Pro | — | **Active** |
| Wordfence Security | 8.1.2 | **Active** |
| Novamira (MCP server for AI agents; staging/dev only) | 1.7.0 | **Active** |
| Akismet Anti-spam | 5.7 | Inactive |
| Hello Dolly | 1.7.2 | Inactive |

All are third-party plugins (not tracked in git). Premium plugins
(Elementor Pro, Rank Math Pro) were installed from licensed zips uploaded
via wp-admin on 2026-07-16.

## Hosting notes

- Server enforces rate limiting on `wp-login.php` (returns HTTP 429 on rapid
  attempts; server banner "hws").
- LiteSpeed server (implied by LiteSpeed Cache being pre-installed).

## Next steps

- [ ] Decide theme approach: custom block theme vs. child theme vs. page builder.
- [ ] Configure site basics on staging (title, permalinks, front page).
- [ ] Scaffold the custom theme in `wp-content/themes/` and commit it here.
- [ ] Set up a deploy path from this repo to staging (e.g. GitHub Action over SFTP/SSH once server credentials are available).
