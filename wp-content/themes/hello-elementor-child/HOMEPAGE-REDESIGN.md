# Uberrito Homepage Redesign

## Implementation

The `/uberrito-home/` page is now rendered by `page-uberrito-home.php`. The template keeps the existing Elementor header and footer but replaces the database-only Elementor homepage body with a version-controlled experience.

The redesign is deliberately scoped with the `ub-home-redesign` body class. No other page should inherit its layout or interaction styles.

## Homepage flow

1. Rotating promotion rail: one offer is visible at a time.
2. Rewards-led full-screen hero with optional kitchen video.
3. Moving brand promise.
4. Evergreen Fresh Picks with two changeable featured items.
5. Full-width menu discovery grid.
6. Catering story.
7. Official merchandise story.
8. NÜ Rewards story.
9. Atascocita and Sugar Land closing section.

## Confirmed routes

- Ordering: `https://uberrito.toast.site/`
- Rewards information: `/rewards/`
- Catering: `/catering/`
- Locations: `/locations/`
- Apple app: `https://apps.apple.com/us/app/%C3%BCberrito-fresh-mex/id1569506904`
- Android app: Google Play search for Uberrito

## Performance and accessibility

- The large MP4 has no initial `src`. It loads only on desktop when reduced motion and data saver are off.
- The hero keeps a WebP poster so it remains complete without video.
- Below-the-fold photography uses native lazy loading.
- Scroll reveals use `IntersectionObserver` and animate only transform/opacity.
- Pointer tilt, magnetic movement, marquees, and video stop under `prefers-reduced-motion` or coarse-pointer conditions.
- Interactive elements retain semantic links, readable labels, and keyboard behavior.

## Content still requiring owner confirmation

- A location-aware rewards registration destination. The current staging signup goes directly to the Atascocita Toast account, so promotional CTAs currently use the neutral `/rewards/` page.
- The final SMS/email enrollment URL and offer fulfillment rules for the free-drink promotion.
- The official merchandise store URL. The current button scrolls to the collection image rather than linking to an unconfirmed store.
- Legal terms, eligibility, expiration dates, and redemption limits for all four promotional messages.
- A final approved chips-and-queso hero image. The current composition uses existing Uberrito chips-and-dips photography.
- A compressed hero video derivative. The repository video is roughly 23 MB; the conditional loader protects initial performance, but a 3–5 MB web-ready export is preferred.

## Validation before merge

1. Deploy the feature branch to staging or a review environment.
2. Purge LiteSpeed and Elementor generated CSS caches.
3. Verify desktop, tablet, and mobile layouts while logged out.
4. Test all four offer rotations and CTAs.
5. Confirm both location pathways and reward enrollment behavior.
6. Run Lighthouse and check LCP, CLS, keyboard focus, and reduced motion.
