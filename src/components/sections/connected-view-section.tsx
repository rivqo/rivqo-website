import { Container } from "@/components/layout/container";
import { SectionIntro } from "@/components/layout/section-intro";
import { InViewReveal } from "@/components/motion/in-view-reveal";
import { ConnectedViewBoard } from "@/components/sections/connected-view-board";
import { connectedView } from "@/data/homepage";

export function ConnectedViewSection() {
  return (
    <section
      aria-labelledby="connected-heading"
      className="section-space border-y border-border bg-muted/40"
    >
      <Container>
        <SectionIntro
          eyebrow={connectedView.eyebrow}
          heading={connectedView.heading}
          headingId="connected-heading"
          lines={[
            "Keep the tools that work.",
            "Connect the workflow that does not.",
          ]}
        >
          <p>{connectedView.support}</p>
        </SectionIntro>

        <InViewReveal amount="some">
          <ConnectedViewBoard />
        </InViewReveal>
      </Container>
    </section>
  );
}
