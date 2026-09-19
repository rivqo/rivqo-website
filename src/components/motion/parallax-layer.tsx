"use client";

import { motion, useScroll, useTransform } from "motion/react";
import { useRef, type RefObject } from "react";
import { useDesktop } from "@/components/motion/use-desktop";
import { usePrefersReducedMotion } from "@/components/motion/use-prefers-reduced-motion";

type ParallaxLayerProps = {
  children: React.ReactNode;
  className?: string;
  from?: number;
  to?: number;
  fade?: boolean;
  target?: RefObject<HTMLElement | null>;
};

export function ParallaxLayer({
  children,
  className,
  from = 0,
  to = -72,
  fade = false,
  target,
}: ParallaxLayerProps) {
  const ref = useRef<HTMLDivElement>(null);
  const reduced = usePrefersReducedMotion();
  const desktop = useDesktop();
  const { scrollYProgress } = useScroll({
    target: target ?? ref,
    offset: ["start start", "end start"],
  });
  const y = useTransform(
    scrollYProgress,
    [0, 0.14, 1],
    [from, from, desktop ? to : to * 0.28],
  );
  const opacity = useTransform(
    scrollYProgress,
    [0, 0.2, 0.78, 1],
    [1, 1, 0.9, 0.42],
  );

  if (reduced) {
    return <div className={className}>{children}</div>;
  }

  return (
    <motion.div
      ref={ref}
      className={className}
      style={{ y, opacity: fade ? opacity : 1 }}
    >
      {children}
    </motion.div>
  );
}
