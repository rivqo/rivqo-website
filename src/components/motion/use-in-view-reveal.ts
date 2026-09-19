"use client";

import { useInView } from "motion/react";
import { useLayoutEffect, useRef, useState } from "react";

const REDUCE_QUERY = "(prefers-reduced-motion: reduce)";

export function useInViewReveal<T extends Element = HTMLDivElement>(
  amount: number | "some" = 0.18,
) {
  const ref = useRef<T | null>(null);
  const inView = useInView(ref, {
    once: true,
    amount,
    margin: "0px 0px -10% 0px",
  });
  const [allowMotion, setAllowMotion] = useState(false);

  useLayoutEffect(() => {
    const id = window.setTimeout(() => {
      setAllowMotion(!window.matchMedia(REDUCE_QUERY).matches);
    }, 0);

    return () => window.clearTimeout(id);
  }, []);

  const instant = !allowMotion;
  const visible = !allowMotion || inView;

  return { ref, visible, instant };
}
