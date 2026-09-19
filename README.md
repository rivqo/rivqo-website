# Rivqo website

Corporate site for Rivqo Digital LTD, an operations-improvement and systems implementation company for project-based businesses.

## Setup

Requires Node.js 20.9+ and [pnpm](https://pnpm.io/) 9.15.9.

```bash
pnpm install
```

Copy `.env.example` to `.env.local` and fill only the values you have. The site builds and runs without Resend, Cloudflare or PostHog keys.

## Routes

| Path          | Purpose                                                                  |
| ------------- | ------------------------------------------------------------------------ |
| `/`           | Homepage: problems, roles, capabilities, method, industries, credibility |
| `/solutions`  | Detailed operational improvement areas                                   |
| `/method`     | Diagnostic-to-rollout method, fit and limits                             |
| `/industries` | Industry realities and sample workflows                                  |
| `/about`      | Positioning, principles, proof boundary                                  |
| `/contact`    | Email-first conversation page                                            |
| `/privacy`    | Privacy notice                                                           |

Primary navigation: Solutions, Method, Industries, About. Primary CTA: Start a conversation → `/contact`, with `ola@rivqo.com` beside every conversion path. The logo returns to `/`.

## Contact

Public contact is [ola@rivqo.com](mailto:ola@rivqo.com). Form delivery is postponed. The enquiry form remains on `/contact` but does not claim a successful send. There is no public phone number, office address or booking link.

## Environment variables

| Name                                         | Purpose                                                            |
| -------------------------------------------- | ------------------------------------------------------------------ |
| `NEXT_PUBLIC_SITE_URL`                       | Canonical site URL. Use `https://rivqo.com` in production.         |
| `ENQUIRY_DELIVERY_ENABLED`                   | Must be `true` before the form may send. Leave unset at launch.    |
| `RESEND_API_KEY`                             | Server-only Resend key. Unused while delivery is postponed.        |
| `ENQUIRY_TO_EMAIL`                           | Inbox for later form delivery. Production value: `ola@rivqo.com`.  |
| `ENQUIRY_FROM_EMAIL`                         | Rivqo-owned sender on a domain verified in Resend.                 |
| `NEXT_PUBLIC_CLOUDFLARE_WEB_ANALYTICS_TOKEN` | Optional Cloudflare Web Analytics token. Loads only in production. |
| `NEXT_PUBLIC_POSTHOG_ENABLED`                | Must be `true` before PostHog may load. Leave unset for launch.    |
| `NEXT_PUBLIC_POSTHOG_KEY`                    | Optional later event analytics. Leave empty for launch.            |
| `NEXT_PUBLIC_POSTHOG_HOST`                   | Optional PostHog host. Unused when the Cloudflare token is set.    |
| `ENQUIRY_TEST_MODE`                          | Test-only. Never set in production.                                |

## Development

```bash
pnpm dev
pnpm lint
pnpm format
pnpm typecheck
pnpm build
pnpm test
```

`pnpm test` runs Vitest, then Playwright against `next start` on port 3002. Build first.

## Production

See `docs/deploy.md` for host options, DNS, headers, smoke tests and rollback. See `docs/launch.md` for later Resend setup.

Read `docs/design-principles.md`, `docs/content-principles.md`, `docs/motion.md` and `docs/qa/pages.md` before changing copy, layout or animation.
