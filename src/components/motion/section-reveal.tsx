"use client";

import { motion } from "motion/react";
import { useInViewReveal } from "@/components/motion/use-in-view-reveal";
import { motionTokens } from "@/lib/motion";
import { cn } from "@/lib/utils";

type RevealPattern = "editorial" | "assemble" | "directional" | "layered";
type Direction = "up" | "left" | "right";

type SectionRevealProps = {
  children: React.ReactNode;
  className?: string;
  pattern?: RevealPattern;
  direction?: Direction;
  delay?: number;
  amount?: number | "some";
};

const directionOffset = {
  up: { x: 0, y: motionTokens.reveal.board },
  left: { x: -motionTokens.reveal.directional, y: 0 },
  right: { x: motionTokens.reveal.directional, y: 0 },
} as const;

export function SectionReveal({
  children,
  className,
  pattern = "editorial",
  direction = "up",
  delay = 0,
  amount = 0.28,
}: SectionRevealProps) {
  const { ref, visible, instant } = useInViewReveal(amount);
  const offset = directionOffset[direction];

  const hidden =
    pattern === "assemble"
      ? { opacity: 0, y: 48, scale: motionTokens.scale.enter }
      : pattern === "layered"
        ? { opacity: 0, y: 36, scale: 0.98 }
        : { opacity: 0, x: offset.x, y: offset.y };

  return (
    <motion.div
      ref={ref}
      className={cn(className)}
      initial={false}
      animate={visible ? { opacity: 1, x: 0, y: 0, scale: 1 } : hidden}
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
