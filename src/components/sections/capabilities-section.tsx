"use client";

import Link from "next/link";
import { motion } from "motion/react";
import { ArrowUpRight } from "lucide-react";
import { Container } from "@/components/layout/container";
import { Button } from "@/components/ui/button";
import { SectionIntro } from "@/components/layout/section-intro";
import { useInViewReveal } from "@/components/motion/use-in-view-reveal";
import { capabilities } from "@/data/homepage";
import { motionTokens } from "@/lib/motion";
import { cn } from "@/lib/utils";

export function CapabilitiesSection() {
  return (
    <section
      id="capabilities"
      aria-labelledby="capabilities-heading"
      className="section-space scroll-mt-24"
    >
      <Container>
        <SectionIntro
          eyebrow={capabilities.eyebrow}
          heading={capabilities.heading}
          headingId="capabilities-heading"
          lines={[
            "The workflows that decide",
            "whether a project stays on track.",
          ]}
        />

        <ol className="mt-12 divide-y divide-border border-y border-border">
          {capabilities.items.map((item, index) => (
            <CapabilityRow key={item.id} item={item} index={index} />
          ))}
        </ol>
        <div className="mt-8">
          <Button href="/solutions" variant="secondary" data-cta="capabilities">
            Explore solutions
          </Button>
        </div>
      </Container>
    </section>
  );
}

function CapabilityRow({
  item,
  index,
}: {
  item: (typeof capabilities.items)[number];
  index: number;
}) {
  const { ref, visible, instant } = useInViewReveal<HTMLLIElement>(0.22);
  const Icon = item.icon;
  const reverse = index % 2 === 1;

  return (
    <motion.li
      ref={ref}
      className={cn(
        "capability-row group grid gap-6 py-6 lg:py-8 lg:items-start",
        reverse
          ? "lg:grid-cols-[minmax(0,20rem)_minmax(0,1fr)_2.5rem]"
          : "lg:grid-cols-[2.5rem_minmax(0,1fr)_minmax(0,20rem)]",
      )}
      initial={false}
      animate={
        visible ? { opacity: 1, x: 0 } : { opacity: 0, x: reverse ? 56 : -56 }
      }
      transition={{
        duration: instant || !visible ? 0 : motionTokens.duration.slow,
        delay: instant || !visible ? 0 : index * 0.04,
        ease: motionTokens.ease.out,
      }}
    >
      <Icon
        aria-hidden="true"
        className={cn(
          "capability-icon size-6 text-primary",
          reverse && "lg:order-3",
        )}
      />
      <div className={cn(reverse && "lg:order-2")}>
        <h3 className="flex items-center gap-2 text-xl font-medium tracking-tight">
          <Link href={`/solutions#${item.id}`} className="hover:text-primary">
            {item.title}
          </Link>
          <ArrowUpRight
            aria-hidden="true"
            className="capability-arrow size-4 text-primary"
          />
        </h3>
        <p className="mt-3 max-w-xl text-muted-foreground">{item.outcome}</p>
      </div>
      <ul
        className={cn(
          "capability-details space-y-2 font-mono text-label text-muted-foreground",
          reverse && "lg:order-1",
        )}
      >
        {item.examples.map((example) => (
          <li key={example} className="border-l-2 border-primary/30 pl-3">
            {example}
          </li>
        ))}
      </ul>
    </motion.li>
  );
}
