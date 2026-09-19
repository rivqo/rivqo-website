import { Container } from "@/components/layout/container";
import { PageHero } from "@/components/layout/page-hero";
import { RelatedCta } from "@/components/layout/related-cta";
import { ConditionalMedia } from "@/components/media/conditional-media";
import { SectionReveal } from "@/components/motion/section-reveal";
import { FounderComposition } from "@/components/pages/founder-composition";
import { StaggerList } from "@/components/motion/stagger-list";
import { getConfirmedImage } from "@/lib/images";
import {
  aboutContrast,
  aboutPage,
  aboutPerspective,
  aboutPrinciples,
  aboutProof,
  aboutWhy,
} from "@/data/about";
import { createPageMetadata } from "@/lib/metadata";

export const metadata = createPageMetadata({
  title: aboutPage.title,
  description: aboutPage.description,
  path: "/about",
});

export default function AboutPage() {
  const founderOne = getConfirmedImage("about-founder-1");
  const founderTwo = getConfirmedImage("about-founder-2");
  const session = getConfirmedImage("about-session");

  return (
    <main id="main-content">
      <PageHero
        eyebrow={aboutPage.eyebrow}
        heading={aboutPage.heading}
        headingLines={aboutPage.headingLines}
        crumbs={[
          { label: "Home", href: "/" },
          { label: "About", href: "/about" },
        ]}
      >
        <p>{aboutPage.positioning}</p>
        <p className="mt-4">{aboutPage.founding}</p>
      </PageHero>

      <Container>
        {founderOne || founderTwo || session ? (
          <div className="section-space grid gap-6 border-b border-border md:grid-cols-2">
            <ConditionalMedia
              id="about-founder-1"
              sizes="(max-width: 767px) 100vw, 36rem"
            />
            <ConditionalMedia
              id="about-founder-2"
              sizes="(max-width: 767px) 100vw, 36rem"
            />
            {session ? (
              <div className="md:col-span-2">
                <ConditionalMedia
                  id="about-session"
                  sizes="(max-width: 767px) 100vw, 72rem"
                />
              </div>
            ) : null}
          </div>
        ) : null}

        <FounderComposition />

        <SectionReveal
          pattern="editorial"
          className="section-space max-w-2xl border-b border-border"
        >
          <h2>{aboutWhy.title}</h2>
          <p className="mt-5 text-lede text-muted-foreground">
            {aboutWhy.body}
          </p>
        </SectionReveal>

        <SectionReveal
          pattern="editorial"
          className="section-space max-w-2xl border-b border-border"
        >
          <h2>{aboutPerspective.title}</h2>
          <p className="mt-5 text-lede text-muted-foreground">
            {aboutPerspective.body}
          </p>
        </SectionReveal>

        <SectionReveal
          pattern="layered"
          className="section-space border-b border-border"
        >
          <h2>Operating principles</h2>
          <StaggerList
            className="mt-10 grid gap-8 md:grid-cols-2"
            itemClassName="border-t border-border pt-5"
            items={aboutPrinciples.map((principle) => (
              <div key={principle.title}>
                <h3 className="text-lg font-medium tracking-tight">
                  {principle.title}
                </h3>
                <p className="mt-3 text-muted-foreground">{principle.body}</p>
              </div>
            ))}
          />
        </SectionReveal>

        <SectionReveal
          pattern="editorial"
          className="section-space border-b border-border"
        >
          <h2>How Rivqo is different</h2>
          <p className="mt-5 max-w-2xl text-muted-foreground">
            These are differences of starting point, not claims that other
            approaches never work.
          </p>
          <StaggerList
            className="mt-10 space-y-8"
            itemClassName="max-w-2xl"
            items={aboutContrast.map((item) => (
              <div key={item.title}>
                <h3 className="text-lg font-medium tracking-tight">
                  {item.title}
                </h3>
                <p className="mt-3 text-muted-foreground">{item.body}</p>
              </div>
            ))}
          />
        </SectionReveal>

        <SectionReveal pattern="layered" className="section-space max-w-2xl">
          <h2>{aboutProof.title}</h2>
          <p className="mt-5 text-lede">{aboutProof.body}</p>
        </SectionReveal>
      </Container>

      <RelatedCta
        eyebrow="How we work"
        heading="Evidence first. Expansion after the pilot holds."
        actions={[
          {
            href: "/method",
            label: "See how Rivqo works",
            cta: "about-method",
          },
        ]}
      />
    </main>
  );
}
