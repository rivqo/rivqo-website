"use client";

import { useScroll, useSpring } from "motion/react";
import type { RefObject } from "react";
import { motionTokens } from "@/lib/motion";

export function useSmoothedProgress(
  ref: RefObject<HTMLElement | null>,
  offset: [string, string] = ["start start", "end end"],
) {
  const { scrollYProgress } = useScroll({
    target: ref,
    offset: offset as never,
  });

  return useSpring(scrollYProgress, motionTokens.spring.progress);
}
