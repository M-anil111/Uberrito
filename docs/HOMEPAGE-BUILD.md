# Homepage Build — Elementor Pro

The staging homepage (https://staging.uberrito.com) is built entirely in
**Elementor Pro**, block by block, on the **Hello Elementor** theme. It
follows the approved mockups (green-on-cream "Fresh. Bold. Mexican." look)
with CAVA-style warmth and simplicity.

## Design system (Elementor global kit)

| Token | Value | Use |
|---|---|---|
| Forest Green | `#1F4D2C` | primary brand, headings, buttons |
| Lime | `#8CBF3F` | accent highlights, "→", emphasis words |
| Charcoal | `#2E2E28` | body text |
| Sage | `#EEF4E3` | section backgrounds |
| Cream | `#FAF7EE` | alternating section backgrounds |
| Sage Deep | `#DDE8C9` | newsletter block background |

- **Display font:** Oswald (condensed, uppercase H1/H2) — matches the bold
  headline treatment in the mockups.
- **Body/UI font:** Poppins.
- **Buttons:** forest-green pills, uppercase, lime hover.
- Global logo + favicon set from the official brand horizontal logo.

## Section order (top → bottom)

1. **Hero** — "Fresh. Bold. Burritos Made Daily." + Order Now / Explore Menu, trust ticks, parallax burrito image.
2. **Limited Time Offer** — "Summer Just Got More Delicious" split card.
3. **Summer Faves** — two seasonal item cards (steak burrito, chicken bowl).
4. **Find Your Flavors** — 6-tile menu category grid (Burritos, Bowls, Quesadillas & Nachos, Salads, Chips/Dips/Sides, Soups), each linking to Toast ordering.
5. **Get That Protein** — 6 protein circles + Build Your Bowl.
6. **Uberrito Rewards** — "Eat More. Earn More. Enjoy More." 3-step explainer.
7. **Stay In The Loop** — email + SMS signup (Elementor form).
8. **Order From Your Location** — two location cards, Pickup / Delivery buttons.
9. **Catering Made Easy** — pitch + "Starting at $12/person" + Get a Quote.
10. **Mobile App** — App Store CTA.
11. **Why Uberrito** — Fresh Ingredients / Made Fresh Daily / 40+ Ingredients trust cards.
12. **Header** (sticky, Theme Builder) + **Footer** (4-column, CAVA-style).

All "Order Now" / Pickup CTAs point to the live Toast ordering URLs; Rewards
CTAs point to the Toast rewards signup.

## Scroll animations (Apple-style)

Elementor's built-in entrance animations were replaced with a lightweight
**IntersectionObserver reveal system** (`.ubr-reveal`, `.ubr-zoom`,
`.ubr-right` + staggered `.ubr-d1..d4` delays) using premium easing
(`cubic-bezier(.22,1,.36,1)`), scale, and directional translate for a slick
"fly-through" feel. This also avoids the LiteSpeed-delayed-JS problem where
Elementor animations leave elements stuck invisible until user interaction.
Respects `prefers-reduced-motion`.

Additional motion:
- **Scroll progress bar** (`#ubr-progress`) — orange→green gradient at the top.
- **Parallax** on the hero image (`.ubr-parallax`, rAF-throttled).
- Cards/tiles lift on hover (`.ubr-tile`).

All effects use GPU-cheap `transform`/`opacity` only.

## Conversion features

Built to drive orders, members, app installs, and SMS/email opt-ins:

- **Full-screen mobile menu** (`.ubr-menu`) — Chipotle-style: big Oswald links
  with orange arrows, an orange **Join Über Rewards** card
  (Create Account / "Already a member? Sign in"), Order Now, social icons, and
  a faint Ü stamp watermark. Opened by a custom hamburger; native horizontal
  nav stays on desktop.
- **Mobile sticky action bar** (`.ubr-mobilebar`) — fixed bottom bar with an
  orange **Order Now** plus **Locations** and **Rewards**.
- **Lead-capture popup** (Elementor Pro popup, id 49) — "Get 20% Off Your First
  Order", email + mobile fields, triggered after 8s or on exit-intent, shown
  once per session (sessionStorage). Directly serves the #1 goal (SMS/email
  enrollment).
- **Order Now** buttons use the vibrant **Uberrito Orange** (`#EC5A2A`)
  site-wide so the primary conversion action always pops; secondary actions
  stay forest-green/outline.

## Footer

Four groups (brand, Explore, Support, Order). On mobile it collapses to a
**two-column grid** (brand spans full width) with Sitemap and Privacy Policy
added under Support. Social icons use each network's brand color.

## Performance (toward 100 PageSpeed)

Applied on staging:

- **LiteSpeed Cache**: full page cache, CSS/JS minify + combine, deferred JS,
  critical/used-CSS (UCSS) with the reveal classes safelisted, font-display
  swap, emoji removal, DNS prefetch.
- **Images**: WebP generated for all 93 media files (~8.2 MB saved, ~53%
  smaller hero), lazy-load enabled with the hero LCP image excluded, oversized
  full images dropped to `large`.
- **Object cache**: Redis (already provisioned on the host).
- **Lean DOM**: ~760 nodes on the homepage.

The scroll animations add only a few KB of inline JS and GPU-cheap
transforms, so they do not meaningfully affect the score.

**On the PageSpeed number:** a *certified* score could not be generated from
the build sandbox — the shared anonymous PageSpeed Insights API quota was
exhausted (HTTP 429), and the sandbox egress proxy returns an interstitial to
headless Chrome, so a local Lighthouse run against staging isn't
representative either. The certified number must be read from
https://pagespeed.web.dev/ against the real domain (one click), or via the PSI
API with a project API key. All the standard 90-100-range levers are in place
(full-page cache, minified/deferred CSS+JS, UCSS, WebP, lazy-load, Redis
object cache, lean ~760-node DOM), but we should not claim "100" until it's
measured on the live domain.

## How it was built

Everything was authored programmatically through the **Novamira MCP server**
(see DEVELOPMENT.md) by writing Elementor's `_elementor_data` JSON directly —
containers, widgets, global kit settings, and Theme Builder header/footer with
`include/general` display conditions. Brand and food imagery was sideloaded
from the live uberrito.com media library and the shared Google Drive brand
folder into the staging media library.

## Open items to confirm before launch

- **Locations**: exact open locations + addresses/hours (cards currently show
  Champions + Atascocita, marked "confirm").
- **App**: Android/Play Store link (only iOS confirmed) and final label.
- **Catering price anchor**: `$12/person` is a placeholder.
- **License keys**: enter Elementor Pro + Rank Math Pro license keys in
  wp-admin to enable updates and pro template libraries.
