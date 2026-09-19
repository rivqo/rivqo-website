"use client";

import { animate } from "motion/react";
import { useLayoutEffect, useRef } from "react";
import { usePrefersReducedMotion } from "@/components/motion/use-prefers-reduced-motion";
import { motionTokens, readEntranceMode } from "@/lib/motion";
import { cn } from "@/lib/utils";

type EntranceProps = {
  children: React.ReactNode;
  className?: string;
  delay?: number;
  y?: number;
  scale?: number;
};

export function Entrance({
  children,
  className,
  delay = 0,
  y = motionTokens.reveal.body,
  scale = 1,
}: EntranceProps) {
  const ref = useRef<HTMLDivElement>(null);
  const reduced = usePrefersReducedMotion();

  useLayoutEffect(() => {
    const node = ref.current;
    if (!node) {
      return;
    }

    const mode = reduced ? "none" : readEntranceMode();
    if (mode !== "full" && mode !== "short") {
      node.style.opacity = "1";
      node.style.transform = "none";
      return;
    }

    const short = mode === "short";
    const controls = animate(
      node,
      { opacity: 1, y: 0, scale: 1 },
      {
        delay: short ? delay * 0.28 : delay,
        duration: short
          ? motionTokens.duration.shortEntrance
          : motionTokens.duration.entrance,
        ease: motionTokens.ease.out,
      },
    );

    return () => controls.stop();
  }, [delay, reduced]);

  return (
    <div
      ref={ref}
      className={cn("entrance-pending", className)}
      style={
        {
          "--entrance-y": `${y}px`,
          "--entrance-scale": String(scale),
        } as React.CSSProperties
      }
    >
      {children}
    </div>
  );
}
