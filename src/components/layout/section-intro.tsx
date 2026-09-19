"use client";

import { CopyReveal, TextReveal } from "@/components/motion/text-reveal";
import { cn } from "@/lib/utils";

type SectionIntroProps = {
  eyebrow?: string;
  heading: string;
  headingId: string;
  lines?: string[];
  children?: React.ReactNode;
  className?: string;
};

export function SectionIntro({
  eyebrow,
  heading,
  headingId,
  lines,
  children,
  className,
}: SectionIntroProps) {
  return (
    <div className={cn("max-w-2xl", className)}>
      {eyebrow ? (
        <CopyReveal>
          <p className="font-mono text-label text-primary">{eyebrow}</p>
        </CopyReveal>
      ) : null}
      <TextReveal
        as="h2"
        id={headingId}
        className="mt-3"
        lines={lines ?? [heading]}
        delay={0.06}
      />
      {children ? (
        <CopyReveal
          className="mt-5 max-w-xl text-lede text-muted-foreground"
          delay={0.14}
        >
          {children}
        </CopyReveal>
      ) : null}
    </div>
  );
}
