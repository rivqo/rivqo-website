# Supporting pages QA

Reviewed at 390, 768, 1024 and 1440. Captures in this folder use the `page-` prefix.

## Route map

- `/` homepage
- `/solutions` six operational areas
- `/method` four stages, needs, scope, limits, fit
- `/industries` five industry sections
- `/about` positioning, principles, contrast, proof boundary
- `/contact` enquiry form with email fallback
- `/privacy` privacy notice

## Navigation

- Desktop and mobile links go to the routes above
- Current route uses `aria-current="page"`
- Logo returns to `/`
- Primary CTA goes to `/contact`
- Homepage hash ids remain for contextual CTAs
- Refresh and direct URL entry work on every page

## Contact

- Homepage has no form
- `/contact` mounts `#enquiry-form`
- Visible email fallback: `ola@rivqo.com`
- Fallback CTA: `mailto:ola@rivqo.com?subject=Operational%20improvement%20enquiry`
- No phone, address, booking calendar or “coming soon”

## Still unpublished

- Phone number
- Office address
- Booking link
- Founder biographies
- Verified case studies

## Form delivery

The public form lives on `/contact`. If Resend is not configured, submission shows the failure copy and the email fallback. Do not invent a success state.
