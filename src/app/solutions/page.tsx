import { Container } from "@/components/layout/container";
import { PageHero } from "@/components/layout/page-hero";
import { RelatedCta } from "@/components/layout/related-cta";
import { CapabilityDetail } from "@/components/pages/capability-detail";
import { SystemsMap } from "@/components/pages/systems-map";
import { solutionAreas, solutionsPage } from "@/data/solutions";
import { createPageMetadata } from "@/lib/metadata";

export const metadata = createPageMetadata({
  title: solutionsPage.title,
  description: solutionsPage.description,
  path: "/solutions",
});

export default function SolutionsPage() {
  return (
    <main id="main-content">
      <PageHero
        eyebrow={solutionsPage.eyebrow}
        heading={solutionsPage.heading}
        headingLines={solutionsPage.headingLines}
        crumbs={[
          { label: "Home", href: "/" },
          { label: "Solutions", href: "/solutions" },
        ]}
      >
        <p>{solutionsPage.introduction}</p>
      </PageHero>

      <Container>
        <SystemsMap />
        {solutionAreas.map((area, index) => (
          <CapabilityDetail key={area.id} area={area} index={index} />
        ))}
      </Container>

      <RelatedCta
        eyebrow="How we work"
        heading="Prove one workflow before expanding the system."
        actions={[
          {
            href: "/method",
            label: "See how Rivqo works",
            cta: "solutions-method",
          },
        ]}
      >
        <p>{solutionsPage.closer}</p>
      </RelatedCta>
    </main>
  );
}
