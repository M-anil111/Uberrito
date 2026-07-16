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

## Scroll animations

Elementor's built-in entrance animations were replaced with a lightweight
**IntersectionObserver reveal system** (`.ubr-reveal`, `.ubr-zoom`,
`.ubr-right` + staggered `.ubr-d1..d4` delays). This avoids the
LiteSpeed-delayed-JS problem where Elementor animations leave elements stuck
invisible until user interaction. Respects `prefers-reduced-motion`.

Menu tiles, protein circles, location and rewards cards lift on hover
(`.ubr-tile`).

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

**Note:** a formal Google PageSpeed Insights score should be run against the
production domain after launch (the shared PSI API quota was exhausted during
the build, and staging measured through the dev proxy is not representative of
real HTTP/2 + edge-cache performance). All the standard 90-100-range levers
are in place.

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
