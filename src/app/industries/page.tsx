import { Container } from "@/components/layout/container";
import { PageHero } from "@/components/layout/page-hero";
import { RelatedCta } from "@/components/layout/related-cta";
import { IndustryDetail } from "@/components/pages/industry-detail";
import { industriesPage, industryDetails } from "@/data/industries";
import { createPageMetadata } from "@/lib/metadata";

export const metadata = createPageMetadata({
  title: industriesPage.title,
  description: industriesPage.description,
  path: "/industries",
});

export default function IndustriesPage() {
  return (
    <main id="main-content">
      <PageHero
        eyebrow={industriesPage.eyebrow}
        heading={industriesPage.heading}
        headingLines={industriesPage.headingLines}
        crumbs={[
          { label: "Home", href: "/" },
          { label: "Industries", href: "/industries" },
        ]}
      >
        <p>{industriesPage.introduction}</p>
        <p className="mt-4">{industriesPage.disclaimer}</p>
      </PageHero>

      <Container>
        {industryDetails.map((industry, index) => (
          <IndustryDetail key={industry.id} industry={industry} index={index} />
        ))}
      </Container>

      <RelatedCta
        heading="See the workflows Rivqo improves, or write with one operating problem."
        actions={[
          {
            href: "/solutions",
            label: "Explore solutions",
            variant: "secondary",
            cta: "industries-solutions",
          },
          {
            href: "/contact",
            label: "Start a conversation",
            cta: "industries-contact",
          },
        ]}
      />
    </main>
  );
}
