# Production Lighthouse (Chromium desktop, localhost)

Measured against `next start` after the production-readiness pass. Preset: desktop. Categories requested: performance, accessibility, best-practices, SEO.

| Route         | Performance | Accessibility | Best practices |  SEO |   LCP | CLS |  TBT |
| ------------- | ----------: | ------------: | -------------: | ---: | ----: | --: | ---: |
| `/`           |        1.00 |          1.00 |           1.00 | 1.00 | 0.8 s |   0 | 0 ms |
| `/solutions`  |        1.00 |          1.00 |           1.00 | 1.00 | 0.6 s |   0 | 0 ms |
| `/industries` |        0.99 |          1.00 |           1.00 | 1.00 | 0.9 s |   0 | 0 ms |
| `/contact`    |        1.00 |          1.00 |           1.00 | 1.00 | 0.6 s |   0 | 0 ms |

Raw JSON: `docs/qa/lighthouse/*.json`.

Industries is a hair under a perfect performance score because of the confirmed editorial plates. Next/Image still serves AVIF/WebP derivatives; source PNGs are not in `public/`.
