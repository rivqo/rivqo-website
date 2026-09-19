# Launch configuration

Operational checklist for contact, analytics and production. Do not invent DNS records, contact details or legal claims.

The privacy notice at `/privacy` should be reviewed by qualified Nigerian legal or privacy counsel before Rivqo relies on it for more sensitive data processing.

## Contact at launch

`ola@rivqo.com` is the dependable public contact route. Form delivery is postponed.

- Do not set `ENQUIRY_DELIVERY_ENABLED=true`.
- The contact form stays on `/contact` as a later delivery surface. It does not claim a successful send.
- Every “Start a conversation” path still reaches `/contact` or a `mailto:` link, with the public email beside it.
- There is no booking link.

## Resend (later)

1. Create a Resend account.
2. Add and verify `rivqo.com`.
3. Configure SPF and DKIM using the exact DNS records Resend shows for that domain. Do not copy records from another domain or from this document.
4. Consider adding DMARC for `rivqo.com` after SPF and DKIM pass.
5. Create a restricted API key where Resend supports scoped keys.
6. Set `RESEND_API_KEY` in the deployment platform only.
7. Set `ENQUIRY_TO_EMAIL=ola@rivqo.com`.
8. Set `ENQUIRY_FROM_EMAIL` to a verified Rivqo address, for example `Rivqo Website <website@rivqo.com>`, only after Resend confirms that sender.
9. Set `ENQUIRY_DELIVERY_ENABLED=true` only after a test send succeeds.
10. Confirm replies go to the visitor’s work email (`replyTo`), not to the from address.

The visitor’s email must never be used as `from`.

Future spam controls already in the form code: honeypot field, minimum fill time, payload size limit, field length limits, same-origin check, and an in-memory rate limiter. The in-memory limiter is best-effort only. Connect a platform or KV limiter if spam becomes a problem. Do not add CAPTCHA while delivery is disabled.

## Analytics

Launch measurement is Cloudflare Web Analytics, and only when a token is supplied.

1. Create a Cloudflare Web Analytics site for `rivqo.com`.
2. Set `NEXT_PUBLIC_CLOUDFLARE_WEB_ANALYTICS_TOKEN`.
3. Leave it empty to keep analytics off. The site still builds and runs.
4. Confirm the beacon does not load in development.
5. Confirm `/privacy` matches what is actually enabled.

PostHog is not used at launch. Leave `NEXT_PUBLIC_POSTHOG_ENABLED`, `NEXT_PUBLIC_POSTHOG_KEY` and `NEXT_PUBLIC_POSTHOG_HOST` empty. Leftover keys do not load PostHog unless `NEXT_PUBLIC_POSTHOG_ENABLED=true`. If it is enabled later, add its host to the Content Security Policy first, keep session replay off, and update `/privacy`.

## Production

1. Follow `docs/deploy.md`.
2. Configure secrets in the hosting platform. Do not commit `.env`.
3. Confirm `NEXT_PUBLIC_SITE_URL=https://rivqo.com`.
4. Inspect the Open Graph preview at `/opengraph-image`.
5. Review `/privacy`.
6. Confirm logs do not print enquiry contents.
7. Confirm `ola@rivqo.com` remains public.

## Testing without sending mail

Default `pnpm test` never calls Resend. Unit tests inject a mock mailer. Production resolveMailer ignores `ENQUIRY_TEST_MODE` outside `NODE_ENV=test`.
