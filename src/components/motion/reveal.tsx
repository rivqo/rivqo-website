"use client";

import { motion } from "motion/react";
import { useInViewReveal } from "@/components/motion/use-in-view-reveal";
import { motionTokens } from "@/lib/motion";
import { cn } from "@/lib/utils";

const motionTags = {
  div: motion.div,
  section: motion.section,
  article: motion.article,
  header: motion.header,
  footer: motion.footer,
} as const;

type RevealProps = {
  as?: keyof typeof motionTags;
  className?: string;
  children: React.ReactNode;
};

export function Reveal({ as = "div", className, children }: RevealProps) {
  const { ref, visible, instant } = useInViewReveal(0.2);
  const Component = motionTags[as];

  return (
    <Component
      ref={ref}
      className={cn(className)}
      initial={false}
      animate={
        visible
          ? { opacity: 1, y: 0 }
          : { opacity: 0, y: motionTokens.reveal.body }
      }
      transition={{
        duration: instant || !visible ? 0 : motionTokens.duration.base,
        ease: motionTokens.ease.out,
      }}
    >
      {children}
    </Component>
  );
}
