# Rivqo image library

Photographs and editorial artwork live here. Brand marks stay in `public/brand`.

## Folders

| Folder | Use |
| --- | --- |
| `people/` | Founder portraits and genuine working sessions |
| `industries/` | Contextual industry photographs, never claimed as Rivqo work |
| `editorial/` | Original drawings, document detail, process artwork |
| `case-studies/` | Approved project evidence only |
| `social/` | Optional static sharing art. The live OG image is generated at `/opengraph-image` |

## Naming

`{subject}-{context}-{width}w.webp`

Examples: `founder-workshop-1600w.webp`, `epc-switchyard-context-1600w.webp`.

Do not use `final`, `new`, `stock` or people’s names in filenames until the name is approved for publication.

## Optimisation

- Prefer AVIF or WebP for delivery. Keep source originals outside `public/` (`assets/industries-source/`) so they are not served.
- Record the true pixel width and height in `src/data/images.ts`.
- Typical long edge: 1600px for full-width plates, 960px for portraits, 1200×630 for static social art.
- Quality around 70–80. Do not ship `quality={100}`.

## Source and permission

Every production file needs an entry in `src/data/images.ts` with credit, permission and readiness. Add the same facts to `docs/visual-assets.md`.

Owned, licensed or generated are the only permission values. Generated people are not used as staff portraits.

## Decorative versus informative

- Informative images need concise alt text that states what the picture is for.
- Decorative images use empty alt and should not carry meaning a reader would miss.
- Captions add context the alt text does not repeat, especially “industry context, not a Rivqo project”.

## Case studies

Do not place images in `case-studies/` until the client, result and permission are verified. An empty folder is the correct production state.

## Missing files

Do not invent paths in the manifest. The site stays complete without a photograph.
