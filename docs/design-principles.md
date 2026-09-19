# Design principles

These rules govern visual and interaction decisions for the Rivqo website. They are constraints, not decoration.

## Audience and impression

Rivqo serves project-based operators: electrical, power and renewable-energy EPC companies; indigenous oil-and-gas service and procurement companies; industrial maintenance businesses; and engineering and technical consultancies.

The site should feel precise, composed, technical and trustworthy. It must not read as a fintech landing page, a construction brochure, an individual designer’s portfolio, or a generic SaaS dashboard.

## Colour

- Rivqo turquoise (`#00664E`, sampled from the wordmark) is the primary brand accent.
- The main surface is a warm off-white, not sterile pure white.
- Dark surfaces use deep charcoal and are scoped, not a second global theme.
- Neutral borders stay low-contrast and restrained.
- Amber and red are reserved for operational warning and exception states.
- Gradients are not a primary design device.
- Glassmorphism is not a default treatment.
- Text and background combinations must meet WCAG AA.

On light surfaces, use the logo turquoise for text, links and primary controls. On dark surfaces, use the lighter logo turquoise (`#3EBA9E`) so contrast holds.

## Typography

- Geist Sans is the primary interface and body face.
- Geist Mono is reserved for small operational labels and data.
- Type should be large and confident, with a fluid scale using `clamp()`.
- Headings stay concise. Body measure stays readable.

## Layout and form

- Design mobile-first.
- Use a consistent spacing system and a practical page-width system.
- Favour strong spacing and visual rhythm over dense chrome.
- Rounded corners are controlled and purposeful. Do not round every surface.
- Subtle engineering-grid and operational-interface cues are welcome when they explain structure.
- Use semantic HTML.

## Imagery

- Do not use remote placeholder images that may disappear.
- Do not include fake client logos, testimonials, results or statistics.
- Brand marks stay in `public/brand`. Photographs and artwork use `public/images`.
- Only confirmed files belong in `src/data/images.ts`. Missing photographs keep the current layout.
- See `docs/visual-assets.md` for placements, crops and permission status.

## Motion

Motion exists to explain progress, relationships, state changes and control. It is not decoration.

Approved patterns:

- Shared tokens in `src/lib/motion.ts`
- First-load choreography, then scroll-linked operational stories
- Clipped line reveals, spring-smoothed progress, and Lenis for smooth scrolling
- Transform, opacity and SVG stroke
- CSS hover and focus transitions on fine pointers

Reduced-motion behaviour:

- Render the completed operating state immediately
- Disable Lenis, parallax, pinning and staged delays
- Switch tabs instantly
- The same completed state is what server render and no-JavaScript users see

Performance restrictions:

- Keep the homepage itself a server component
- Limit pinning to the hero flow and the connected view, and only from 1280px
- At 1024px use stacked compositions, not a compressed desktop pin
- Persistent `will-change` and blur filters are not default treatments
- Prefer transform, opacity and stroke
- Keep blur light and brief
- Sequences must settle or remain scroll-driven; do not loop forever

Do not add later:

- GSAP, WebGL, Three.js, Lottie or a second motion library
- A custom cursor or large canvas effects
- Continuous floating, shaking or fake notification counts
- Motion that hides necessary copy until it finishes

See `docs/motion.md` for the meaning of each current sequence.

## Accessibility and performance

- Components must be keyboard usable, with visible `:focus-visible` styles.
- Optimise for Core Web Vitals.
- Default to React Server Components. Add `"use client"` only for browser state, events or animation.

## Homepage compositions

The homepage uses HTML and CSS for operational interface fragments. These are not dashboards and must remain readable when motion is disabled.

- Flow nodes, source chips and the after-state list use `data-motion` attributes for the meaning-bearing sequences documented in `docs/motion.md`.
- Status colours appear only on realistic exception and progress labels.
- Case studies render only when verified entries exist in `src/data/homepage.ts`. An empty list stays hidden.

## Navigation and supporting pages

Primary navigation is route-based: `/solutions`, `/method`, `/industries`, `/about`. The current route uses `aria-current="page"`. Homepage section ids remain for contextual links. Interior pages reuse the header, footer, tokens and a shared page hero, breadcrumbs, outcome panel, process step, capability detail, industry detail and related CTA. Do not pin long operational stories on every supporting page. The homepage remains the most visually dramatic surface.

## Contact path

`/contact` hosts the enquiry form. Email remains visible as a fallback. Do not add a booking calendar or a disabled control that implies submission when delivery is unavailable.

## Performance trade-offs

Lenis remains on for capable pointers when motion is allowed. It stops when the document is hidden, the mobile menu is open, or reduced motion is requested. The first hero line stays visible so Largest Contentful Paint is not waiting on choreography. Supporting section reveals are shorter than the four primary motion moments. A perfect Lighthouse score is not the goal if it would strip those moments.

## Responsive decisions

- 390–1023px: stacked hero and connected view, no sticky pin
- 1024–1279px: desktop navigation where it fits; still no pin
- 1280px and up: two-column hero, pinned operational stories, centred sticky boards

## Reference sites

Authenticom RecordRecharge, Clarvos, Davide Cattaneo and Brilean inform interaction quality, typography, storytelling and visual confidence only. Do not copy their layouts, source, branding, wording, illustrations or distinctive assets.
