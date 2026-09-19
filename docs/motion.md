# Motion meaning

These notes describe why each homepage animation exists. Do not add motion that does not explain a relationship, a state change, or a sequence.

The motion language is cinematic and confident, but still operational. It should feel like a control system assembling, not a marketing splash.

## Motion hierarchy

These four moments carry the page. Do not add competing sequences.

1. Hero assembly, with the first headline line visible immediately for LCP
2. Operational workflow progression
3. Fragmented-to-connected transformation
4. Final CTA entrance

Supporting sections may rise in once. They use shorter travel and duration than the four moments above. Role-panel blur is not used.

## Shared system

Tokens live in `src/lib/motion.ts`. Reusable primitives live in `src/components/motion`.

Approved patterns:

- First-load entrance from a minimal state
- Clipped line reveals for major headings
- Spring-smoothed scroll progress
- Sticky operational stories on large screens only
- Editorial, assembly, directional and layered reveals
- CSS hover and focus treatments on fine pointers
- Lenis smooth scrolling, disabled when motion is reduced or the mobile menu is open

## First-load entrance

Meaning: the operating view is assembled, not unveiled as a brand splash.

- Background and grid are already present
- Logo, navigation, headline, copy, CTAs and the flow board arrive in a short choreography
- Returning visits in the same session use a shorter entrance
- Reduced motion, server render and no-JavaScript show the complete hero immediately

## Operational flow

Meaning: work moves through a controlled path, and exceptions become visible at the point they occur.

- Wide desktop (1280px and up) maps scroll progress to request → approval → vendor → delivery exception → cost → management
- The pin is 160vh. Scrolling backward reverses the path
- Turquoise marks reached stages
- Amber appears when the exception stage is current
- Viewports below 1280px use a shorter in-flow progression without a pin
- Reduced motion shows the completed path immediately

## Connected operating view

Meaning: existing tools stay in place; Rivqo connects the workflow across them.

- Sources begin fragmented
- They gather toward the control layer
- A named packet travelling the connector is information, not decoration
- Targets become the operating outcomes
- Wide desktop uses one controlled sticky sequence at 150vh
- Viewports below 1280px show the comparison in normal flow
- Reduced motion shows a clear before-and-after comparison

## Method rail

Meaning: delivery is sequential and bounded.

- The rail draws with section scroll
- The current stage is dominant; earlier stages stay visible and quieter
- This section is not pinned

## Problem board

Meaning: operational friction is multiple and concurrent.

- Items enter from different directions, then settle into a coherent board
- Hover adds depth and exception emphasis
- No shaking, floating or fake counts

## Role tabs

Meaning: the same operation answers different questions.

- The tab indicator glides
- The incoming panel enters from the navigation direction
- Keyboard behaviour stays on the tabs

## What not to add later

- A second animation library
- Custom cursors
- WebGL, Three.js, Lottie or large canvas effects
- Continuous decorative loops
- Motion that hides copy until it finishes
- Additional pinned sections beyond the hero flow and connected view

## Images

Photographs move on wrappers, not by changing their dimensions. Approved motion is a clipped reveal, a short scale from about 1.04 to 1, and a hover return of colour on monochrome plates. Desktop may add a small parallax later; mobile stays simpler. Reduced motion shows the finished crop immediately. Images must be understandable with motion off.

## Supporting pages

Interior pages reuse the same tokens. They do not pin and they do not repeat the homepage flow.

- Page heroes use the first-load entrance and a clipped headline; the first line stays visible
- Solution and industry copy arrive editorially; the sample trail assembles as a sequence
- Method stages rise in once; activity and output lists stagger
- About principles and contrasts settle as a register
- Contact prompts stagger; the email panel assembles
- Related CTAs use the assemble pattern
- Reduced motion, server render and no-JavaScript show the completed page immediately
