import { Container } from "@/components/layout/container";
import { PageHero } from "@/components/layout/page-hero";
import { SectionReveal } from "@/components/motion/section-reveal";
import { StaggerList } from "@/components/motion/stagger-list";
import { EngagementPath } from "@/components/pages/engagement-path";
import { EnquiryForm } from "@/components/sections/enquiry-form";
import { contactPage } from "@/data/contact";
import { enquiryMailto, publicEmail } from "@/lib/contact";
import { enquiryDeliveryEnabled } from "@/lib/enquiry/delivery";
import { createPageMetadata } from "@/lib/metadata";

export const metadata = createPageMetadata({
  title: contactPage.title,
  description: contactPage.description,
  path: "/contact",
});

export default function ContactPage() {
  const email = publicEmail();
  const mailto = enquiryMailto();
  const deliveryEnabled = enquiryDeliveryEnabled();

  return (
    <main id="main-content">
      <PageHero
        eyebrow={contactPage.eyebrow}
        heading={contactPage.heading}
        headingLines={contactPage.headingLines}
        crumbs={[
          { label: "Home", href: "/" },
          { label: "Contact", href: "/contact" },
        ]}
      >
        <p>{contactPage.introduction}</p>
      </PageHero>

      <Container>
        <EngagementPath />
      </Container>

      <Container className="section-space grid gap-14 lg:grid-cols-[minmax(0,1fr)_minmax(0,22rem)] lg:items-start">
        <div className="border border-border bg-muted/50 p-6 sm:p-8">
          <h2 className="font-mono text-label text-primary">
            {contactPage.formTitle}
          </h2>
          <p className="mt-3 text-sm text-muted-foreground">
            {contactPage.formSupport}
          </p>
          {email ? (
            <p className="mt-4 text-sm">
              Write to{" "}
              <a
                href={mailto}
                className="font-medium underline underline-offset-2"
              >
                {email}
              </a>
              .
            </p>
          ) : null}
          <div className="mt-6">
            <EnquiryForm
              contactEmail={email}
              deliveryEnabled={deliveryEnabled}
            />
          </div>
        </div>

        <SectionReveal pattern="editorial" direction="right">
          <h2>{contactPage.promptsTitle}</h2>
          <StaggerList
            className="mt-6 list-disc space-y-3 pl-5 text-muted-foreground"
            items={contactPage.prompts}
          />

          <h2 className="mt-12">{contactPage.expectationsTitle}</h2>
          <StaggerList
            className="mt-6 list-disc space-y-3 pl-5 text-muted-foreground"
            items={contactPage.expectations}
          />
        </SectionReveal>
      </Container>
    </main>
  );
}
