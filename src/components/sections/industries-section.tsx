"use client";

import Link from "next/link";
import { motion } from "motion/react";
import { Container } from "@/components/layout/container";
import { Button } from "@/components/ui/button";
import { SectionIntro } from "@/components/layout/section-intro";
import { useInViewReveal } from "@/components/motion/use-in-view-reveal";
import { industries } from "@/data/homepage";
import { motionTokens } from "@/lib/motion";

export function IndustriesSection() {
  return (
    <section
      id="industries"
      aria-labelledby="industries-heading"
      className="section-space scroll-mt-24 border-y border-border"
    >
      <Container>
        <SectionIntro
          eyebrow={industries.eyebrow}
          heading={industries.heading}
          headingId="industries-heading"
          lines={["Engineering, energy and", "industrial-service companies."]}
        />

        <ul className="mt-12 divide-y divide-border border-y border-border">
          {industries.items.map((item, index) => (
            <IndustryRow key={item.id} item={item} index={index} />
          ))}
        </ul>
        <div className="mt-8">
          <Button href="/industries" variant="secondary" data-cta="industries">
            Explore industries
          </Button>
        </div>
      </Container>
    </section>
  );
}

function IndustryRow({
  item,
  index,
}: {
  item: (typeof industries.items)[number];
  index: number;
}) {
  const { ref, visible, instant } = useInViewReveal<HTMLLIElement>(0.28);

  return (
    <motion.li
      ref={ref}
      className="industry-row group grid gap-4 py-7 md:grid-cols-[4rem_minmax(0,18rem)_minmax(0,1fr)]"
      initial={false}
      animate={visible ? { opacity: 1, y: 0 } : { opacity: 0, y: 48 }}
      transition={{
        duration: instant || !visible ? 0 : motionTokens.duration.slow,
        delay: instant || !visible ? 0 : index * motionTokens.stagger.tight,
        ease: motionTokens.ease.out,
      }}
    >
      <p className="industry-index font-mono text-label text-muted-foreground">
        {String(index + 1).padStart(2, "0")}
      </p>
      <h3 className="text-2xl font-medium tracking-tight md:text-3xl">
        <Link href={`/industries#${item.id}`} className="hover:text-primary">
          {item.title}
        </Link>
      </h3>
      <div className="max-w-xl space-y-3 text-muted-foreground">
        {item.realities.map((reality) => (
          <p key={reality}>{reality}</p>
        ))}
      </div>
    </motion.li>
  );
}
