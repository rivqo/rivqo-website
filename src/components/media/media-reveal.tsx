"use client";

import { motion } from "motion/react";
import { useDesktop } from "@/components/motion/use-desktop";
import { useInViewReveal } from "@/components/motion/use-in-view-reveal";
import { motionTokens } from "@/lib/motion";

type MediaRevealProps = {
  children: React.ReactNode;
};

export function MediaReveal({ children }: MediaRevealProps) {
  const { ref, visible, instant } = useInViewReveal(0.24);
  const desktop = useDesktop();
  const scaleFrom = instant || !desktop ? 1 : 1.04;

  return (
    <motion.div
      ref={ref}
      className="media-reveal"
      initial={false}
      animate={
        visible
          ? { clipPath: "inset(0% 0% 0% 0%)", scale: 1 }
          : { clipPath: "inset(8% 8% 8% 8%)", scale: scaleFrom }
      }
      transition={{
        duration: instant || !visible ? 0 : motionTokens.duration.slow,
        ease: motionTokens.ease.out,
      }}
    >
      {children}
    </motion.div>
  );
}
