# Step 4 homepage audit

Inspected at 390, 768, 1024, 1440 and 1728, plus reduced-motion. Captures in this folder.

## Keep

- Approved hero headline and supporting paragraph.
- Consistent CTA language: “Start a conversation” and “See how Rivqo works”.
- Section compositions already vary: editorial, interface, tabs, sequence, transformation, rail, industry index, credibility, final CTA.
- Honest form states and hidden empty case-study list.
- Reduced-motion settled states on the operational flow and connected view.
- No horizontal overflow at the audited widths.
- Footer omits unconfirmed contact details.
- Keyboard role tabs, skip link, and visible focus outline.

## Improve

- Hero eyebrow names a category, not who Rivqo serves. The ten-second test needs the audience in the first viewport more plainly.
- Capabilities heading (“Control the workflows that control delivery”) is clever and vague. Industries heading is generic.
- “Operating view” / “operational control” repeat outside the places they earn.
- No mid-page route to the final CTA after the method.
- Footer has links but no conversion action.
- Desktop sticky scenes are 200vh and 190vh. After the first cycle, extra scroll adds little information.
- 1024px uses the compressed desktop pin and two-column hero on a short landscape viewport.
- Supporting reveals (0.88s, 68px travel, role-panel blur) compete with the four main motion moments.
- Persistent `will-change` on headline lines and hero lines held at opacity 0 delay LCP.
- Capability and problem hover lifts the whole row and shifts neighbours.
- Form needs a privacy expectation, fuller autofill, and `aria-required`.
- Metadata title/description do not match the recommended direction. No canonical, Open Graph or Twitter fields.
- Credibility is honest but visually thin; present scope boundaries more clearly without inventing proof.

## Remove

- Role-panel blur (expensive, not meaning-bearing).
- Persistent `will-change` on settled text.
- Excess hide-the-headline entrance on the first hero line (blocks LCP).
- Hover translation on full capability and problem rows.

## Requires confirmation

- Phone number and physical address (still unpublished).
- Verified case studies.
- Whether 1024px should ever use the desktop pin (this audit treats it as tablet: stacked, no pin).
- Counsel review of `/privacy`. Email, enquiry destination and the Open Graph image were added in Step 5.
