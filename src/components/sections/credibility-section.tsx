"use client";

import { motion } from "motion/react";
import { Container } from "@/components/layout/container";
import { ConditionalMedia } from "@/components/media/conditional-media";
import { Button } from "@/components/ui/button";
import { SectionIntro } from "@/components/layout/section-intro";
import { useInViewReveal } from "@/components/motion/use-in-view-reveal";
import { credibility } from "@/data/homepage";
import { motionTokens } from "@/lib/motion";

export function CredibilitySection() {
  const { ref, visible, instant } = useInViewReveal<HTMLUListElement>(0.22);

  return (
    <section
      id="about"
      aria-labelledby="about-heading"
      className="section-space scroll-mt-24"
    >
      <Container>
        <SectionIntro
          eyebrow={credibility.eyebrow}
          heading={credibility.heading}
          headingId="about-heading"
        >
          <p>{credibility.body}</p>
        </SectionIntro>

        <ConditionalMedia
          id="credibility-session"
          className="mt-10 max-w-xl"
          sizes="(max-width: 767px) 100vw, 36rem"
        />

        <ul
          ref={ref}
          className="mt-12 grid gap-8 border-t border-border pt-8 md:grid-cols-3"
        >
          {credibility.pillars.map((pillar, index) => (
            <motion.li
              key={pillar.title}
              className="border-t border-border pt-5 md:border-t-0 md:border-l md:pt-0 md:pl-6 md:first:border-l-0 md:first:pl-0"
              initial={false}
              animate={
                visible
                  ? { opacity: 1, y: 0, scale: 1 }
                  : { opacity: 0, y: 36, scale: 0.98 }
              }
              transition={{
                duration: instant || !visible ? 0 : motionTokens.duration.base,
                delay: instant || !visible ? 0 : index * 0.08,
                ease: motionTokens.ease.out,
              }}
            >
              <h3 className="text-lg font-medium tracking-tight">
                {pillar.title}
              </h3>
              <p className="mt-3 text-muted-foreground">{pillar.body}</p>
            </motion.li>
          ))}
        </ul>

        <p className="mt-10 max-w-2xl text-muted-foreground">
          {credibility.scope}
        </p>
        <div className="mt-8">
          <Button href="/about" variant="secondary" data-cta="about">
            Read about Rivqo
          </Button>
        </div>

        {credibility.caseStudies.length > 0 ? (
          <div className="mt-14">
            <h3 className="text-lg font-medium tracking-tight">
              Selected work
            </h3>
            <ul className="mt-6 grid gap-6 md:grid-cols-2">
              {credibility.caseStudies.map((study) => (
                <li key={study.title} className="border-t border-border pt-4">
                  <p className="font-medium tracking-tight">{study.title}</p>
                  <p className="mt-2 text-muted-foreground">{study.summary}</p>
                </li>
              ))}
            </ul>
          </div>
        ) : null}
      </Container>
    </section>
  );
}
