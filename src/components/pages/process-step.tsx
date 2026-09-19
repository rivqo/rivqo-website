import { SectionReveal } from "@/components/motion/section-reveal";
import { StaggerList } from "@/components/motion/stagger-list";
import { TextReveal } from "@/components/motion/text-reveal";
import type { MethodDetail } from "@/types/pages";

type ProcessStepProps = {
  stage: MethodDetail;
};

export function ProcessStep({ stage }: ProcessStepProps) {
  return (
    <article
      id={stage.id}
      aria-labelledby={`${stage.id}-heading`}
      className="scroll-mt-24 border-t border-border"
    >
      <SectionReveal
        pattern="editorial"
        className="section-space relative grid gap-10 lg:grid-cols-[minmax(0,8rem)_minmax(0,1fr)]"
      >
        <p className="font-mono text-label text-primary">{stage.number}</p>
        <div>
          <TextReveal
            as="h2"
            id={`${stage.id}-heading`}
            lines={[stage.title]}
          />
          <p className="mt-5 max-w-2xl text-lede text-muted-foreground">
            {stage.summary}
          </p>
          {stage.activities ? (
            <div className="mt-8">
              <h3 className="font-mono text-label text-muted-foreground">
                Likely activities
              </h3>
              <StaggerList
                className="mt-3 grid gap-2 sm:grid-cols-2"
                itemClassName="border-l-2 border-primary/30 pl-3 text-sm"
                items={stage.activities}
              />
            </div>
          ) : null}
          {stage.outputs ? (
            <div className="mt-8">
              <h3 className="font-mono text-label text-muted-foreground">
                Standard outputs
              </h3>
              <StaggerList
                className="mt-3 grid gap-2 sm:grid-cols-2"
                itemClassName="border-l-2 border-primary/30 pl-3 text-sm"
                items={stage.outputs}
              />
            </div>
          ) : null}
          {stage.points ? (
            <StaggerList
              className="mt-8 grid gap-2 sm:grid-cols-2"
              itemClassName="border-l-2 border-primary/30 pl-3 text-sm"
              items={stage.points}
            />
          ) : null}
        </div>
      </SectionReveal>
    </article>
  );
}
