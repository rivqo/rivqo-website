# Visual assets

This is the production record for Rivqo imagery. The site stays complete without future photographs. Do not invent file paths, download stock, generate staff portraits or claim a pictured site as Rivqo work.

Readiness values: **Confirmed**, **Awaiting real asset**, **Suitable for original artwork**, **Decorative only**, **Do not use**.

## Audit

| Page       | Section                                              | Benefit of photography                           | Keep interface-led                     | Abstract artwork                                                    | Image adds no value                                        | Mobile crop risk                            | Accidental placeholder              |
| ---------- | ---------------------------------------------------- | ------------------------------------------------ | -------------------------------------- | ------------------------------------------------------------------- | ---------------------------------------------------------- | ------------------------------------------- | ----------------------------------- |
| Home       | Hero                                                 | No                                               | Yes. Operational flow stays the hero.  | No                                                                  | A photograph would replace the product story.              | Hero already stacks below 1280px.           | None                                |
| Home       | Problems / roles / capabilities / connected / method | No                                               | Yes                                    | No                                                                  | Extra pictures would compete with the four motion moments. | —                                           | None                                |
| Home       | Industries                                           | Low                                              | Yes, the numbered index is enough.     | No                                                                  | A row of thumbnails would look like a brochure.            | Cropping faces or plants at 390px.          | None                                |
| Home       | Credibility                                          | Yes, one real working session or founder image.  | Pillars stay typographic.              | No                                                                  | More than one picture makes the homepage image-heavy.      | Face or table edge at 390px.                | Empty case-study list stays hidden. |
| Home       | Final CTA                                            | No                                               | Yes                                    | No                                                                  | A customer-service photo would cheapen the close.          | —                                           | None                                |
| Solutions  | Areas                                                | No photographs                                   | Yes. Sample trails stay code-rendered. | Optional document or drawing detail later, not six matching photos. | Six stock photos would invent a product catalogue.         | Tight 22rem board column.                   | None                                |
| Method     | Stages                                               | One genuine workshop or review.                  | Yes until that asset exists.           | Process diagrams already exist as lists.                            | A stock “team workshop” implies Rivqo staff.               | 3:2 crop, protect table and documents.      | None                                |
| Industries | Five sectors                                         | Yes. Editorial plates now sit with each section. | Sample workflows stay beside the art.  | Confirmed original editorial artwork is in use.                     | Claiming the pictured site as a Rivqo project.             | Keep the central subject; native 4/3 helps. | None                                |
| About      | Body                                                 | Two founder portraits and one optional session.  | Copy stays until names are confirmed.  | No                                                                  | Anonymous stock portraits.                                 | Headroom and eyes in the upper third.       | None                                |
| Contact    | Form                                                 | No                                               | Yes                                    | No                                                                  | A headset photograph is generic and false.                 | —                                           | None                                |
| Privacy    | —                                                    | No                                               | Yes                                    | No                                                                  | —                                                          | —                                           | None                                |
| Social     | Open Graph                                           | Generated artwork, not photography.              | —                                      | Logo, positioning line, brand surface.                              | Screenshots, metrics, client logos.                        | Fixed 1200×630.                             | None                                |

## Confirmed assets

| Proposed image            | Page and section                     | Purpose                          | Type                      | Dimensions | Aspect   | Mobile crop                                 | Alt-text                                                                                                     | Source                                                    | Permission                | Readiness                            |
| ------------------------- | ------------------------------------ | -------------------------------- | ------------------------- | ---------- | -------- | ------------------------------------------- | ------------------------------------------------------------------------------------------------------------ | --------------------------------------------------------- | ------------------------- | ------------------------------------ |
| Wordmark                  | Header, footer                       | Identify Rivqo                   | Brand raster              | 148×62     | 148/62   | Full mark visible                           | Informative in the footer (`Rivqo`). Decorative in the header because the link already names the home page.  | `public/brand/rivqo-logo.png`                             | Owned                     | Confirmed                            |
| Mark                      | Open Graph / Twitter                 | Identify Rivqo on a sharing card | Brand raster              | 55×56      | 55/56    | Not cropped                                 | Decorative                                                                                                   | `public/brand/mark.png`                                   | Owned                     | Confirmed                            |
| Sharing card              | `/opengraph-image`, `/twitter-image` | Social sharing                   | Generated `ImageResponse` | 1200×630   | 1200/630 | Fixed canvas                                | “Rivqo — Better systems for complex operations.”                                                             | Code in `src/app/opengraph-image.tsx`                     | Generated from owned mark | Confirmed                            |
| Electrical and power EPC  | Industries, EPC                      | Industry context                 | Editorial artwork         | 1448×1086  | 4/3      | Keep the substation structure in the centre | “Electrical substation equipment against a dawn sky, typical of power EPC delivery.”                         | `public/images/industries/electrical-power-epc.webp`      | Owned/generated for Rivqo | Confirmed original editorial artwork |
| Renewable-energy delivery | Industries, renewables               | Industry context                 | Editorial artwork         | 1448×1086  | 4/3      | Keep the array and substation together      | “Solar array and a small substation in open country, typical of renewable-energy delivery.”                  | `public/images/industries/renewable-energy-delivery.webp` | Owned/generated for Rivqo | Confirmed original editorial artwork |
| Oil-and-gas services      | Industries, oil and gas              | Industry context                 | Editorial artwork         | 1448×1086  | 4/3      | Keep the valves and pallets in the centre   | “Flanged valves, fittings and crate-stored materials in a warehouse, typical of oil-and-gas procurement.”    | `public/images/industries/oil-gas-procurement.webp`       | Owned/generated for Rivqo | Confirmed original editorial artwork |
| Industrial maintenance    | Industries, maintenance              | Industry context                 | Editorial artwork         | 1448×1086  | 4/3      | Keep the pump and motor in the centre       | “Industrial pump, motor and pipework on a plant floor, typical of industrial maintenance.”                   | `public/images/industries/industrial-maintenance.webp`    | Owned/generated for Rivqo | Confirmed original editorial artwork |
| Engineering consultancy   | Industries, consultancy              | Industry context                 | Editorial artwork         | 1448×1086  | 4/3      | Keep the tablet and drawings in the centre  | “Engineering drawings, a tablet, calipers and material samples on a desk, typical of technical consultancy.” | `public/images/industries/engineering-consultancy.webp`   | Owned/generated for Rivqo | Confirmed original editorial artwork |

## Approved placements, awaiting files

These slots are wired. They render only after a confirmed row is added to `src/data/images.ts`.

| Proposed image        | Page and section       | Purpose           | Type       | Dimensions | Aspect | Mobile crop                              | Alt-text                                                                                              | Source                                  | Permission | Readiness           |
| --------------------- | ---------------------- | ----------------- | ---------- | ---------- | ------ | ---------------------------------------- | ----------------------------------------------------------------------------------------------------- | --------------------------------------- | ---------- | ------------------- |
| Working session       | Home, credibility      | Human credibility | Photograph | 1600×1067  | 3/2    | Keep people and documents in the centre. | Name the activity, not demographics. Example: “Rivqo workshop reviewing a project procurement trail.” | `public/images/people/`                 | Pending    | Awaiting real asset |
| Method workshop       | Method, after the hero | Editorial depth   | Photograph | 1800×1200  | 3/2    | Keep the table and notes.                | “Rivqo planning session during a diagnostic review.”                                                  | `public/images/people/` or `editorial/` | Pending    | Awaiting real asset |
| Founder portrait 1    | About                  | Human credibility | Photograph | 1200×1500  | 4/5    | Eyes in the upper third.                 | Use the confirmed name only when biography is also approved.                                          | `public/images/people/`                 | Pending    | Awaiting real asset |
| Founder portrait 2    | About                  | Human credibility | Photograph | 1200×1500  | 4/5    | Eyes in the upper third.                 | Same name rule.                                                                                       | `public/images/people/`                 | Pending    | Awaiting real asset |
| About working session | About                  | Editorial depth   | Photograph | 1800×1200  | 3/2    | Documents and people together.           | Activity, not “our team helping a client”.                                                            | `public/images/people/`                 | Pending    | Awaiting real asset |

Industry plates use the caption “Industry context artwork. Not a Rivqo client project.” Source is recorded as original Rivqo editorial artwork. The homepage industries index stays typographic.

## Rejected or unused

| Proposed image                     | Page and section | Purpose                                   | Type                   | Readiness                                |
| ---------------------------------- | ---------------- | ----------------------------------------- | ---------------------- | ---------------------------------------- |
| Photographic homepage hero         | Home, hero       | Would replace the operational composition | Photograph             | Do not use                               |
| Six solution photographs           | Solutions        | Matching stock for each area              | Photograph             | Do not use                               |
| Homepage industry thumbnails       | Home, industries | Brochure rhythm                           | Photograph             | Do not use                               |
| Final CTA lifestyle photo          | Home, start      | Fake warmth                               | Photograph             | Do not use                               |
| Contact headset / office           | Contact          | Generic service image                     | Photograph             | Do not use                               |
| Anonymous stock portraits          | About            | Fake employees                            | Photograph / generated | Do not use                               |
| Case-study photography             | Home / about     | Proof                                     | Photograph             | Do not use until a verified study exists |
| Client logos, metrics, screenshots | Social           | False evidence                            | Mixed                  | Do not use                               |
| Generated people as staff          | Any              | False identity                            | Generated              | Do not use                               |

## Code-rendered visuals already in production

These are the current operational pictures. They are not photographs and they do not wait on the asset library.

- Homepage hero workflow
- Connected operating view
- Solution and industry sample trails
- Method stages as a written sequence

Original editorial artwork may later sit beside a trail. It must be drawn or photographed for Rivqo, not a generic systems illustration.

## How to add a confirmed photograph

1. Place the optimised file in the correct `public/images/` folder.
2. Add one `SiteImage` row to `src/data/images.ts` with the real path, width, height, alt, caption, credit, permission and `readiness: "confirmed"`.
3. Use the placement id the page already asks for (`industry-epc`, `method-workshop`, `about-founder-1`, and so on).
4. Update this table to Confirmed.
5. Do not add a second invented portrait or a “coming soon” frame.
