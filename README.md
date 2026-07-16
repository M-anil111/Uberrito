# Uberrito — WordPress Site

Source control for the Uberrito website build.

- **Staging:** https://staging.uberrito.com
- **Production:** https://www.uberrito.com

## What this repo tracks

The repo mirrors the WordPress document root, but only **custom code** is
version-controlled:

- Custom themes → `wp-content/themes/<theme-name>/`
- Custom plugins → `wp-content/plugins/<plugin-name>/`
- Project documentation → `docs/`

WordPress core, third-party themes/plugins, uploads, caches, and all
configuration/credentials (`wp-config.php`, `.env`, database dumps) are
excluded via `.gitignore`. Third-party dependencies are installed and updated
through the WordPress admin on each environment.

As custom themes/plugins are created, commit them here — only known
third-party directories are ignored by name.

## Current state of staging

See [`docs/SITE-INVENTORY.md`](docs/SITE-INVENTORY.md) for the recorded
baseline (WordPress version, themes, installed plugins). As of 2026-07-15 the
staging site is a fresh, stock WordPress install with no custom code yet.

## Workflow

1. Branch from `main` for each piece of work.
2. Commit custom theme/plugin code here.
3. Open a PR — CI runs PHP syntax checks + WordPress coding standards
   automatically.
4. Merge to `main` — the deploy workflow pushes tracked code to staging for
   QA at https://staging.uberrito.com.
5. Promote to production after sign-off.

More detail:

- [`docs/DEVELOPMENT.md`](docs/DEVELOPMENT.md) — GitHub CLI + WP-CLI setup,
  branch workflow, local linting
- [`docs/DEPLOYMENT.md`](docs/DEPLOYMENT.md) — CI/CD pipeline and the
  one-time secrets setup needed to enable staging deploys

**Never commit:** `wp-config.php`, salts/keys, API keys, database dumps, or
anything from `wp-content/uploads/`.
