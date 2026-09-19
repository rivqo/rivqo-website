import { Container } from "@/components/layout/container";
import { SectionIntro } from "@/components/layout/section-intro";
import { InViewReveal } from "@/components/motion/in-view-reveal";
import { CopyReveal } from "@/components/motion/text-reveal";
import { MethodRail } from "@/components/sections/method-rail";
import { ViewTracker } from "@/components/analytics/view-tracker";
import { Button } from "@/components/ui/button";
import { method } from "@/data/homepage";
import { site } from "@/data/site";

export function MethodSection() {
  return (
    <section
      id="method"
      aria-labelledby="method-heading"
      className="section-space scroll-mt-24"
    >
      <ViewTracker event="method_viewed" targetId="method" />
      <Container>
        <SectionIntro
          eyebrow={method.eyebrow}
          heading={method.heading}
          headingId="method-heading"
          lines={["Start with evidence.", "Prove value before expanding."]}
        />

        <InViewReveal amount="some">
          <MethodRail />
        </InViewReveal>

        <CopyReveal delay={0.1} className="mt-10">
          <p className="max-w-2xl text-lede">{method.closer}</p>
          <div className="mt-6 flex flex-wrap gap-3">
            <Button href="/method" variant="secondary" data-cta="method-page">
              Read the method
            </Button>
            <Button href={site.cta.href} data-cta="method">
              {site.cta.label}
            </Button>
          </div>
        </CopyReveal>
      </Container>
    </section>
  );
}
