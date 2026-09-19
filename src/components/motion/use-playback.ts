"use client";

import type { RefObject } from "react";
import { useInViewOnce } from "@/components/motion/use-in-view-once";
import { usePrefersReducedMotion } from "@/components/motion/use-prefers-reduced-motion";
import { useTimedSteps } from "@/components/motion/use-timed-steps";

export function usePlayback(
  ref: RefObject<Element | null>,
  delays: readonly number[],
  amount = 0.32,
) {
  const instant = usePrefersReducedMotion();
  const inView = useInViewOnce(ref, amount);
  const step = useTimedSteps(!instant && inView, instant, delays);

  return {
    instant,
    step,
    settled: instant || step >= delays.length,
  };
}
