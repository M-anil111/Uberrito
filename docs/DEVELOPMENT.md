# Development Guide

## Prerequisites

| Tool | Purpose | Install |
|---|---|---|
| Git | version control | https://git-scm.com |
| GitHub CLI (`gh`) | PRs/issues from the terminal | https://cli.github.com |
| WP-CLI (`wp`) | manage WordPress from the terminal | https://wp-cli.org/#installing |
| PHP 8.2+ & Composer | linting/coding standards locally | https://getcomposer.org |

## GitHub CLI setup (one-time per developer)

```bash
# Install (macOS: brew install gh | Windows: winget install GitHub.cli | Linux: see cli.github.com)
gh auth login          # choose GitHub.com → HTTPS → login with browser
gh repo clone M-anil111/Uberrito
```

Day-to-day:

```bash
gh pr create --draft --title "..." --body "..."   # open a PR
gh pr status                                       # your PRs at a glance
gh pr checks                                       # CI status for current branch
gh pr merge --squash                               # merge when approved
```

## WP-CLI setup

WP-CLI talks to the **staging site over SSH** using the `@staging` alias in
[`wp-cli.yml`](../wp-cli.yml) at the repo root. Once the SSH credentials are
filled in there, from anywhere inside the repo:

```bash
wp @staging core version
wp @staging plugin list
wp @staging cache flush
wp @staging search-replace 'old' 'new' --dry-run
```

Requirements:
- WP-CLI installed locally (`wp --version`)
- SSH access to the staging server (same credentials as the deploy workflow)
- WP-CLI also installed on the server for remote commands
  (`curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && chmod +x wp-cli.phar && sudo mv wp-cli.phar /usr/local/bin/wp`)

The WordPress REST API on staging also supports **Application Passwords**
(wp-admin → Users → Profile → Application Passwords) for programmatic access
without SSH.

## Novamira MCP server (AI-agent access to staging)

Staging runs the [Novamira](https://www.novamira.ai) plugin, which exposes an
MCP server at `https://staging.uberrito.com/wp-json/mcp/novamira` with
abilities to execute PHP, read/write/edit files, and create upload links on
the staging server. **Staging/dev use only — never install on production.**

The repo-level [`.mcp.json`](../.mcp.json) registers this server for Claude
Code automatically. It authenticates with a WordPress Application Password
via the `NOVAMIRA_MCP_AUTH` environment variable (never committed):

1. In staging wp-admin → Users → Profile → Application Passwords, create one
   (e.g. named after yourself or the tool).
2. Base64-encode `username:application-password`:
   `printf '%s' 'you@example.com:xxxx xxxx xxxx xxxx xxxx xxxx' | base64`
3. Set `NOVAMIRA_MCP_AUTH` to that value in your shell profile, or for
   Claude Code on the web add it as an environment variable in the
   environment settings.

## Branch & PR workflow

1. `git checkout -b feature/<short-name>` from `main`.
2. Commit custom theme/plugin code (see `.gitignore` — un-ignore new custom
   themes/plugins explicitly).
3. `gh pr create --draft` — CI runs PHP syntax checks and WordPress coding
   standards (PHPCS) automatically.
4. Mark ready for review; merge to `main` after approval.
5. Merging to `main` auto-deploys tracked code to staging
   (see [DEPLOYMENT.md](DEPLOYMENT.md)).

## Linting locally (same as CI)

```bash
composer global config allow-plugins.dealerdirect/phpcodesniffer-composer-installer true
composer global require wp-coding-standards/wpcs:"^3.1" dealerdirect/phpcodesniffer-composer-installer:"^1.0"
phpcs --standard=WordPress-Extra --extensions=php wp-content/
```
