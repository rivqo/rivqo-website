"use client";

import { useInView } from "motion/react";
import type { RefObject } from "react";

export function useInViewOnce(ref: RefObject<Element | null>, amount = 0.32) {
  return useInView(ref, {
    once: true,
    amount,
    margin: "0px 0px -10% 0px",
  });
}
