import { ConditionalMedia } from "@/components/media/conditional-media";
import { SectionReveal } from "@/components/motion/section-reveal";
import { CopyReveal, TextReveal } from "@/components/motion/text-reveal";
import { WorkflowBoard } from "@/components/pages/workflow-board";
import type { IndustryDetail as IndustryDetailType } from "@/types/pages";

type IndustryDetailProps = {
  industry: IndustryDetailType;
  index: number;
};

const visualLayout = [
  "aside",
  "banner",
  "copy",
  "board-first",
  "split",
] as const;

export function IndustryDetail({ industry, index }: IndustryDetailProps) {
  const reverse = index % 2 === 1;
  const layout = visualLayout[index] ?? "aside";
  const visualId = `industry-${industry.id}`;
  const sizesAside = "(max-width: 1023px) 100vw, 22rem";
  const sizesCopy = "(max-width: 1023px) 100vw, 42rem";
  const sizesBanner = "(max-width: 1023px) 100vw, 72rem";

  return (
    <article
      id={industry.id}
      aria-labelledby={`${industry.id}-heading`}
      className="scroll-mt-24 border-t border-border"
    >
      {layout === "banner" ? (
        <SectionReveal pattern="layered" className="pt-10 sm:pt-14">
          <ConditionalMedia id={visualId} sizes={sizesBanner} />
        </SectionReveal>
      ) : null}

      <div className="section-space grid gap-10 lg:grid-cols-[minmax(0,1.15fr)_minmax(0,22rem)] lg:items-start">
        <SectionReveal
          pattern="editorial"
          direction={reverse ? "right" : "left"}
        >
          <p className="font-mono text-label text-muted-foreground">
            {String(index + 1).padStart(2, "0")}
          </p>
          <TextReveal
            as="h2"
            id={`${industry.id}-heading`}
            className="mt-3"
            lines={[industry.title]}
          />
          <CopyReveal className="mt-5 max-w-2xl text-lede text-muted-foreground">
            <p>{industry.complexity}</p>
          </CopyReveal>
          {layout === "copy" ? (
            <div className="mt-8 max-w-2xl">
              <ConditionalMedia id={visualId} sizes={sizesCopy} />
            </div>
          ) : null}
          <div className="mt-8 grid gap-8 sm:grid-cols-2">
            <div>
              <h3 className="font-mono text-label text-muted-foreground">
                Questions management needs answered
              </h3>
              <ul className="mt-3 list-disc space-y-2 pl-5 text-sm text-muted-foreground">
                {industry.questions.map((question) => (
                  <li key={question}>{question}</li>
                ))}
              </ul>
            </div>
            <div>
              <h3 className="font-mono text-label text-muted-foreground">
                Relevant Rivqo capabilities
              </h3>
              <ul className="mt-3 space-y-2 text-sm">
                {industry.capabilities.map((item) => (
                  <li key={item} className="border-l-2 border-primary/30 pl-3">
                    {item}
                  </li>
                ))}
              </ul>
            </div>
          </div>
          <p className="mt-8 max-w-2xl text-sm text-muted-foreground">
            {industry.disclaimer}
          </p>
        </SectionReveal>
        <SectionReveal
          pattern="assemble"
          direction={reverse ? "left" : "right"}
          className="space-y-6"
        >
          {layout === "aside" ? (
            <ConditionalMedia id={visualId} sizes={sizesAside} />
          ) : null}
          {layout === "board-first" ? (
            <>
              <WorkflowBoard
                title="Sample workflow"
                nodes={industry.workflow}
              />
              <ConditionalMedia id={visualId} sizes={sizesAside} />
            </>
          ) : null}
          {layout !== "board-first" ? (
            <WorkflowBoard title="Sample workflow" nodes={industry.workflow} />
          ) : null}
        </SectionReveal>
      </div>
      {layout === "split" ? (
        <SectionReveal pattern="layered" className="pb-10 sm:pb-14">
          <ConditionalMedia id={visualId} sizes={sizesBanner} />
        </SectionReveal>
      ) : null}
    </article>
  );
}
