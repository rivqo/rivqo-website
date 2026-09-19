"use client";

import { createContext, useContext, useEffect, useMemo } from "react";
import { markEntranceSeen, motionTokens, readEntranceMode } from "@/lib/motion";
import { usePrefersReducedMotion } from "@/components/motion/use-prefers-reduced-motion";

type MotionContextValue = {
  reduced: boolean;
};

const MotionContext = createContext<MotionContextValue>({
  reduced: true,
});

export function useMotionContext() {
  return useContext(MotionContext);
}

export function MotionProvider({ children }: { children: React.ReactNode }) {
  const reduced = usePrefersReducedMotion();

  useEffect(() => {
    if (reduced) {
      return;
    }

    const mode = readEntranceMode();
    if (mode !== "full" && mode !== "short") {
      return;
    }

    const wait =
      mode === "short"
        ? motionTokens.duration.shortEntrance * 1000 + 240
        : 1900;

    const timer = window.setTimeout(() => {
      markEntranceSeen();
    }, wait);

    return () => window.clearTimeout(timer);
  }, [reduced]);

  const value = useMemo(() => ({ reduced }), [reduced]);

  return (
    <MotionContext.Provider value={value}>{children}</MotionContext.Provider>
  );
}
