import { SectionReveal } from "@/components/motion/section-reveal";
import { CopyReveal, TextReveal } from "@/components/motion/text-reveal";
import { OutcomePanel } from "@/components/pages/outcome-panel";
import { WorkflowBoard } from "@/components/pages/workflow-board";
import type { SolutionArea } from "@/types/pages";

type CapabilityDetailProps = {
  area: SolutionArea;
  index: number;
};

export function CapabilityDetail({ area, index }: CapabilityDetailProps) {
  const reverse = index % 2 === 1;

  return (
    <article
      id={area.id}
      aria-labelledby={`${area.id}-heading`}
      className="scroll-mt-24 border-t border-border"
    >
      <div className="section-space grid gap-10 lg:grid-cols-[minmax(0,1.2fr)_minmax(0,22rem)] lg:items-start">
        <SectionReveal
          pattern="editorial"
          direction={reverse ? "right" : "left"}
        >
          <p className="font-mono text-label text-muted-foreground">
            {String(index + 1).padStart(2, "0")}
          </p>
          <TextReveal
            as="h2"
            id={`${area.id}-heading`}
            className="mt-3"
            lines={[area.title]}
          />
          <CopyReveal
            className="mt-6 space-y-5 text-muted-foreground"
            delay={0.06}
          >
            <p>
              <span className="font-medium text-foreground">
                The operating problem.{" "}
              </span>
              {area.problem}
            </p>
            <p>
              <span className="font-medium text-foreground">
                What Rivqo may improve.{" "}
              </span>
              {area.improvement}
            </p>
          </CopyReveal>
          <SectionReveal pattern="layered" delay={0.08} className="mt-6">
            <OutcomePanel>{area.outcome}</OutcomePanel>
          </SectionReveal>
          <div className="mt-8 grid gap-8 sm:grid-cols-2">
            <div>
              <h3 className="font-mono text-label text-muted-foreground">
                Signals it may be needed
              </h3>
              <ul className="mt-3 list-disc space-y-2 pl-5 text-sm text-muted-foreground">
                {area.signals.map((signal) => (
                  <li key={signal}>{signal}</li>
                ))}
              </ul>
            </div>
            <div>
              <h3 className="font-mono text-label text-muted-foreground">
                Relevant roles
              </h3>
              <ul className="mt-3 space-y-2 font-mono text-label text-muted-foreground">
                {area.roles.map((role) => (
                  <li key={role} className="border-l-2 border-primary/30 pl-3">
                    {role}
                  </li>
                ))}
              </ul>
            </div>
          </div>
        </SectionReveal>
        <SectionReveal
          pattern="assemble"
          direction={reverse ? "left" : "right"}
          className="space-y-6"
        >
          <WorkflowBoard nodes={area.workflow} />
          <div>
            <h3 className="font-mono text-label text-muted-foreground">
              The trail this may cover
            </h3>
            <ul className="mt-3 space-y-2 font-mono text-label text-muted-foreground">
              {area.covers.map((item) => (
                <li key={item} className="border-l-2 border-border pl-3">
                  {item}
                </li>
              ))}
            </ul>
          </div>
        </SectionReveal>
      </div>
    </article>
  );
}
