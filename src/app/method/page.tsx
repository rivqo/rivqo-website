import { Container } from "@/components/layout/container";
import { PageHero } from "@/components/layout/page-hero";
import { RelatedCta } from "@/components/layout/related-cta";
import { ConditionalMedia } from "@/components/media/conditional-media";
import { SectionReveal } from "@/components/motion/section-reveal";
import { DeliveryJourney } from "@/components/pages/delivery-journey";
import { ProcessStep } from "@/components/pages/process-step";
import {
  goodFit,
  methodDetails,
  methodLimits,
  methodNeeds,
  methodPage,
  methodScope,
  poorFit,
} from "@/data/method";
import { createPageMetadata } from "@/lib/metadata";

export const metadata = createPageMetadata({
  title: methodPage.title,
  description: methodPage.description,
  path: "/method",
});

export default function MethodPage() {
  return (
    <main id="main-content">
      <PageHero
        eyebrow={methodPage.eyebrow}
        heading={methodPage.heading}
        headingLines={methodPage.headingLines}
        crumbs={[
          { label: "Home", href: "/" },
          { label: "Method", href: "/method" },
        ]}
      >
        <p>{methodPage.introduction}</p>
      </PageHero>

      <Container>
        <ConditionalMedia
          id="method-workshop"
          className="section-space max-w-3xl"
          sizes="(max-width: 767px) 100vw, 48rem"
        />
        <DeliveryJourney />
        {methodDetails.map((stage) => (
          <ProcessStep key={stage.id} stage={stage} />
        ))}

        <div className="section-space grid gap-12 border-t border-border lg:grid-cols-2">
          <SectionReveal pattern="editorial" direction="left">
            <section aria-labelledby="needs-heading">
              <h2 id="needs-heading">{methodNeeds.title}</h2>
              <p className="mt-5 text-muted-foreground">{methodNeeds.body}</p>
              <ul className="mt-6 list-disc space-y-2 pl-5 text-sm text-muted-foreground">
                {methodNeeds.items.map((item) => (
                  <li key={item}>{item}</li>
                ))}
              </ul>
            </section>
          </SectionReveal>
          <SectionReveal pattern="editorial" direction="right">
            <section aria-labelledby="scope-heading">
              <h2 id="scope-heading">{methodScope.title}</h2>
              <p className="mt-5 text-muted-foreground">{methodScope.body}</p>
              <ul className="mt-6 list-disc space-y-2 pl-5 text-sm text-muted-foreground">
                {methodScope.items.map((item) => (
                  <li key={item}>{item}</li>
                ))}
              </ul>
            </section>
          </SectionReveal>
        </div>

        <SectionReveal
          pattern="layered"
          className="section-space border-t border-border"
        >
          <h2>{methodLimits.title}</h2>
          <ul className="mt-6 max-w-2xl list-disc space-y-2 pl-5 text-muted-foreground">
            {methodLimits.items.map((item) => (
              <li key={item}>{item}</li>
            ))}
          </ul>
        </SectionReveal>

        <div className="section-space grid gap-12 border-t border-border md:grid-cols-2">
          <SectionReveal pattern="editorial" direction="left">
            <section aria-labelledby="good-fit-heading">
              <h2 id="good-fit-heading">{goodFit.title}</h2>
              <ul className="mt-6 list-disc space-y-2 pl-5 text-sm text-muted-foreground">
                {goodFit.items.map((item) => (
                  <li key={item}>{item}</li>
                ))}
              </ul>
            </section>
          </SectionReveal>
          <SectionReveal pattern="editorial" direction="right">
            <section aria-labelledby="poor-fit-heading">
              <h2 id="poor-fit-heading">{poorFit.title}</h2>
              <ul className="mt-6 list-disc space-y-2 pl-5 text-sm text-muted-foreground">
                {poorFit.items.map((item) => (
                  <li key={item}>{item}</li>
                ))}
              </ul>
            </section>
          </SectionReveal>
        </div>
      </Container>

      <RelatedCta
        dark
        eyebrow="Start a conversation"
        heading="If the problem is already visible, write to Rivqo."
        actions={[
          {
            href: "/contact",
            label: "Start a conversation",
            cta: "method-contact",
          },
        ]}
      >
        <p>
          Suitable work normally begins with a paid diagnostic. The first note
          only needs the workflow that is causing the most delay or repeated
          work.
        </p>
      </RelatedCta>
    </main>
  );
}
