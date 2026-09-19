# Deployment

Prepare a production host for this Next.js 16 application. Do not deploy from this document automatically. Do not invent DNS records.

## Runtime

| Requirement     | Value                                    |
| --------------- | ---------------------------------------- |
| Node.js         | 20.9 or later (`package.json` `engines`) |
| Package manager | pnpm 9.15.9 (`packageManager`)           |
| Framework       | Next.js 16.3.5, App Router, `next start` |

```bash
pnpm install --frozen-lockfile
pnpm build
pnpm start
```

The production server listens on `PORT` when the host provides one. Locally, `pnpm start` uses port 3000.

## Host

The repository does not pin a host. Any platform that can run `pnpm build` and `pnpm start` on Node 20 is supported.

Recommended default: **a Node 20 host that keeps the process running** (Vercel, Railway, Render, Fly.io, a VPS with systemd, or Coolify). This app uses:

- `next/og` for the Open Graph image
- `next/image` for AVIF/WebP industry plates
- server actions for a form that is currently not delivering mail
- no edge-only APIs that require a specific vendor

Vercel is the lowest-friction option for Next.js. A generic Node host is equally valid if Rivqo already has one. Cloudflare Pages is a weaker fit unless the Open Graph image and image optimiser are confirmed on that adapter.

Do not use a static export. The site is not `output: "export"`.

## Environment variables

Required in production:

| Name                   | Value               |
| ---------------------- | ------------------- |
| `NEXT_PUBLIC_SITE_URL` | `https://rivqo.com` |

Leave the rest empty for launch unless the matching service is actually connected.

| Name                                         | Launch state                                         |
| -------------------------------------------- | ---------------------------------------------------- |
| `ENQUIRY_DELIVERY_ENABLED`                   | Unset. Form delivery is postponed.                   |
| `RESEND_API_KEY`                             | Unset until Resend is verified.                      |
| `ENQUIRY_TO_EMAIL`                           | `ola@rivqo.com` when delivery is later enabled.      |
| `ENQUIRY_FROM_EMAIL`                         | Unset until a Rivqo-owned sender is verified.        |
| `NEXT_PUBLIC_CLOUDFLARE_WEB_ANALYTICS_TOKEN` | Unset until a Cloudflare Web Analytics token exists. |
| `NEXT_PUBLIC_POSTHOG_ENABLED`                | Unset for launch.                                    |
| `NEXT_PUBLIC_POSTHOG_KEY`                    | Unset for launch.                                    |
| `NEXT_PUBLIC_POSTHOG_HOST`                   | Unset for launch.                                    |
| `ENQUIRY_TEST_MODE`                          | Never set in production.                             |

Do not commit `.env`. Copy `.env.example` to the host’s secret store.

## Cloudflare Web Analytics

1. In Cloudflare, add a Web Analytics beacon for `rivqo.com`.
2. Copy the token only. Do not invent one.
3. Set `NEXT_PUBLIC_CLOUDFLARE_WEB_ANALYTICS_TOKEN` on the production host.
4. Redeploy. The beacon loads only when `NODE_ENV=production` and the token is present.
5. Confirm `/privacy` still describes cookie-free page-view measurement.
6. Leave the variable empty to keep analytics off. The site still builds.

Do not enable session replay, heatmaps, advertising pixels or PostHog for launch.

## Domain and DNS

1. Point `rivqo.com` at the chosen host using the records that host specifies.
2. Prefer apex `https://rivqo.com` as the canonical origin.
3. Redirect `www.rivqo.com` to `https://rivqo.com` (301).
4. Redirect `http` to `https`.
5. Set `NEXT_PUBLIC_SITE_URL=https://rivqo.com` so canonical, sitemap and Open Graph URLs match.
6. After HTTPS works, add a CAA record only if Rivqo has a chosen certificate authority.

## Security headers

`next.config.ts` sends:

- Content-Security-Policy
- Referrer-Policy: `strict-origin-when-cross-origin`
- X-Content-Type-Options: `nosniff`
- X-Frame-Options: `DENY`
- Permissions-Policy: camera, microphone, geolocation, payment, USB and FLoC disabled
- X-DNS-Prefetch-Control: `off`

CSP exceptions:

- `'unsafe-inline'` for Next.js hydration and the entrance script. Removing it breaks the production app.
- `'unsafe-eval'` in development only.
- `https://static.cloudflareinsights.com` and `https://cloudflareinsights.com` for the optional Cloudflare beacon.

If PostHog is later enabled, add its host to `script-src` and `connect-src` before setting the keys. Do not add a wildcard.

## Production smoke test

1. `https://rivqo.com/` renders the homepage.
2. `/solutions`, `/method`, `/industries`, `/about`, `/contact` and `/privacy` return 200.
3. A nonsense path returns the 404 page.
4. Logo returns to `/`.
5. `mailto:ola@rivqo.com` is visible in the footer and on `/contact`.
6. The contact form does not show a successful-send message.
7. There is no booking link.
8. `/sitemap.xml` and `/robots.txt` list `https://rivqo.com`.
9. `/opengraph-image` and `/twitter-image` return images.
10. Industry images are WebP/AVIF derivatives, not the source PNGs.
11. Browser console has no application errors.
12. Analytics requests are absent unless the Cloudflare token was intentionally set.

## Rollback

1. Redeploy the previous known-good build or git revision.
2. Keep the previous environment-variable set. Do not add keys during an emergency rollback.
3. Confirm the smoke-test list above.
4. If DNS was changed, revert the host records to the previous target and wait for TTL.

## Later form delivery

See `docs/launch.md`. Do not set `ENQUIRY_DELIVERY_ENABLED=true` until Resend, SPF, DKIM and `ENQUIRY_FROM_EMAIL` are confirmed. The public email remains `ola@rivqo.com` either way.
