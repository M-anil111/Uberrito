# Deployment

## How it works

- **CI** (`.github/workflows/ci.yml`): every PR and push to `main` runs a PHP
  syntax check on all tracked PHP files and PHPCS (WordPress-Extra standard)
  on custom `wp-content` code. Both jobs pass trivially while the repo has no
  custom PHP yet.
- **Staging deploy** (`.github/workflows/deploy-staging.yml`): every push to
  `main` (or a manual run from the Actions tab) rsyncs the **git-tracked**
  files under `wp-content/` to the staging server over SSH, then flushes the
  WordPress/LiteSpeed caches via WP-CLI if it's installed on the server.

Safety properties of the deploy:
- Only files tracked by git are uploaded — config, uploads, and third-party
  plugins on the server are never touched.
- Nothing is ever deleted on the server.
- If the SSH secrets are not configured, the workflow skips with a notice
  instead of failing.

## One-time setup (required before deploys go live)

Add these **repository secrets** in
GitHub → Uberrito → Settings → Secrets and variables → Actions:

| Secret | Value |
|---|---|
| `STAGING_SSH_HOST` | staging server hostname or IP |
| `STAGING_SSH_USER` | SSH/SFTP username |
| `STAGING_SSH_KEY` | private key (PEM contents) for that user, no passphrase |
| `STAGING_SSH_PORT` | optional — only if not 22 |
| `STAGING_WP_PATH` | absolute path to the WordPress root, e.g. `/home/user/staging.uberrito.com/public_html` |

Then fill the same host/user/path into the `@staging` alias in
[`wp-cli.yml`](../wp-cli.yml) so developers can use WP-CLI against staging.

If the host only offers password-based SFTP (no SSH keys), say so — the
workflow can be switched to an SFTP action with a `STAGING_SSH_PASSWORD`
secret instead.

## Production

Production deploys are intentionally not automated yet. Once the staging
pipeline is proven, clone `deploy-staging.yml` with `PROD_*` secrets and a
manual `workflow_dispatch`-only trigger (with environment protection rules)
for sign-off-gated releases.
