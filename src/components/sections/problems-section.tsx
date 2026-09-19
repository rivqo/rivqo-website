import { Container } from "@/components/layout/container";
import { SectionIntro } from "@/components/layout/section-intro";
import { CopyReveal } from "@/components/motion/text-reveal";
import { ProblemBoard } from "@/components/sections/problem-board";
import { problems } from "@/data/homepage";

export function ProblemsSection() {
  return (
    <section
      id="problems"
      aria-labelledby="problems-heading"
      className="section-space scroll-mt-24"
    >
      <Container>
        <SectionIntro
          eyebrow={problems.eyebrow}
          heading={problems.heading}
          headingId="problems-heading"
          lines={["Your projects are moving.", "Your information is not."]}
        >
          <p>{problems.support}</p>
        </SectionIntro>

        <ProblemBoard />

        <CopyReveal delay={0.12}>
          <p className="mt-10 max-w-2xl text-lede">{problems.closer}</p>
        </CopyReveal>
      </Container>
    </section>
  );
}
