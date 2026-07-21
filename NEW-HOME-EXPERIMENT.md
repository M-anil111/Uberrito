# Uberrito `/new-home/` experiment

This page is a separate, code-driven homepage concept. It does not replace the current homepage and does not reuse the existing Elementor homepage effects.

## Experience

- Burrito loader with orbiting bean, chip, cheese, and lime symbols.
- Single-message rotating offer rail with four promotions.
- Fixed glass navigation with a compact mobile menu.
- Full-screen food hero using existing Uberrito photography.
- Menu grid, `Food That Feels Good` story, catering, merchandise, rewards, and two-location journey.
- Scroll-driven flight path between Atascocita and Sugar Land.
- Interactive face buttons, magnetic hover states, pointer parallax, menu image previews, and a food-juggling `UBERRITO` footer.

The interaction rhythm is inspired by the pacing of CRAV's site, while the layout, copy, colors, assets, and components are original to Uberrito.

## WordPress setup

1. Deploy the child-theme files from this branch.
2. Create a WordPress page titled `New Home` with the slug `new-home`.
3. Leave the page content empty; WordPress will automatically use `page-new-home.php`.
4. Review the page at `/new-home/` before changing the site homepage setting.

## Content and asset notes

- The concept currently uses brand imagery already stored under `wp-content/uploads/2026/07/`.
- The Sugar Land card uses an interior image because a confirmed Sugar Land exterior asset was not available in the repository.
- Menu and promotional links should be checked against the final Toast and rewards destinations before launch.
- Merchandise uses the approved merch composite. A live shop destination is still needed.

## Performance and accessibility

- Animation is implemented with transforms, opacity, `requestAnimationFrame`, Intersection Observer, and the Web Animations API.
- No new animation library or video dependency is loaded.
- Pointer effects are disabled on coarse-pointer devices.
- `prefers-reduced-motion` removes continuous and entrance motion.
- Below-the-fold images are lazy-loaded; the hero image is prioritized.
- The loader has a hard timeout so it cannot block ordering or navigation indefinitely.
