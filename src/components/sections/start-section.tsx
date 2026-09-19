import { Container } from "@/components/layout/container";
import { InViewReveal } from "@/components/motion/in-view-reveal";
import { CopyReveal, TextReveal } from "@/components/motion/text-reveal";
import { Button } from "@/components/ui/button";
import { start } from "@/data/homepage";
import { enquiryMailto, publicEmail } from "@/lib/contact";
import { site } from "@/data/site";

export function StartSection() {
  const email = publicEmail();

  return (
    <section
      id="start"
      aria-labelledby="start-heading"
      className="surface-dark scroll-mt-24"
    >
      <Container className="section-space grid gap-12 lg:grid-cols-[minmax(0,1fr)_minmax(0,24rem)]">
        <div>
          <CopyReveal>
            <p className="font-mono text-label text-accent-on-dark">
              {start.eyebrow}
            </p>
          </CopyReveal>
          <TextReveal
            as="h2"
            id="start-heading"
            className="mt-3 max-w-[16ch]"
            lines={["Find the workflow", "costing your company", "the most."]}
          />
          <CopyReveal
            className="mt-5 max-w-xl text-lede text-muted-foreground"
            delay={0.12}
          >
            <p>{start.support}</p>
          </CopyReveal>
        </div>

        <InViewReveal>
          <div className="border border-border p-6 sm:p-8">
            <p className="font-mono text-label text-accent-on-dark">
              Direct email
            </p>
            <p className="mt-4 text-lg tracking-tight">
              Write with one operational problem. There is no booking calendar
              and no form on this page.
            </p>
            <div className="mt-6">
              <Button href={site.cta.href} data-cta="start">
                {site.cta.label}
              </Button>
            </div>
            {email ? (
              <p className="mt-6 text-sm text-muted-foreground">
                Or email{" "}
                <a
                  href={enquiryMailto()}
                  className="underline underline-offset-2"
                >
                  {email}
                </a>{" "}
                directly.
              </p>
            ) : null}
          </div>
        </InViewReveal>
      </Container>
    </section>
  );
}
