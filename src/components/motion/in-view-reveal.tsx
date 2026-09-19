"use client";

import { motion } from "motion/react";
import { useInViewReveal } from "@/components/motion/use-in-view-reveal";
import { motionTokens } from "@/lib/motion";
import { cn } from "@/lib/utils";

type InViewRevealProps = {
  children: React.ReactNode;
  className?: string;
  delay?: number;
  y?: number;
  amount?: number | "some";
};

export function InViewReveal({
  children,
  className,
  delay = 0,
  y = motionTokens.reveal.board,
  amount = 0.16,
}: InViewRevealProps) {
  const { ref, visible, instant } = useInViewReveal(amount);

  return (
    <motion.div
      ref={ref}
      className={cn(className)}
      initial={false}
      animate={visible ? { opacity: 1, y: 0 } : { opacity: 0, y }}
      transition={{
        duration: instant || !visible ? 0 : motionTokens.duration.slow,
        delay: instant || !visible ? 0 : delay,
        ease: motionTokens.ease.out,
      }}
    >
      {children}
    </motion.div>
  );
}
