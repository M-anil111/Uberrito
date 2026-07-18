# Front-end Effects

The `uberrito-effects` plugin (`wp-content/plugins/uberrito-effects/`) adds two
site-wide motion effects with pure CSS/JS — no settings screen, no stored data.

## What it does

1. **Page curtain** — on first load a full-screen forest-green (`#1F4D2C`)
   overlay shows the Überrito logo with an orange glow that "heartbeats" in,
   then wipes upward to reveal the page. The curtain replays a short version
   before every **same-origin** navigation, so moving between pages feels
   continuous instead of flashing white. External links, `tel:`/`mailto:`,
   new-tab links, and `#` anchors are left alone. A `pageshow`/bfcache guard
   and a 2.2s timeout guarantee it can never get stuck covering the page.

2. **Staggered menu reveal** — when the full-screen menu (`#ubrMenu`) opens,
   its links (`.ubr-menu__links a`) fade and slide in one after another. This
   is done by wrapping the theme's existing `ubrMenu(open)` toggle and adding
   an `ubr-fx-open` class, so it layers on top of the current menu without
   changing the theme's own open/close logic.

Both effects are fully disabled under `prefers-reduced-motion`.

## Enabling on a site

The plugin is tracked in git but, like any plugin, must be **deployed to the
server and activated** (wp-admin → Plugins → activate "Überrito Effects", or
via WP-CLI `wp plugin activate uberrito-effects`) before it renders. It reads
no options and can be safely deactivated to turn the effects off.

## Logo source

The curtain auto-detects the header logo at runtime; if none is found it falls
back to the constant `UBR_FX_LOGO_FALLBACK` in the plugin. Update that constant
if the logo path changes.
