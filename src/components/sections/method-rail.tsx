"use client";

import { useMotionValueEvent } from "motion/react";
import { useRef, useState } from "react";
import { usePrefersReducedMotion } from "@/components/motion/use-prefers-reduced-motion";
import { useSmoothedProgress } from "@/components/motion/use-smoothed-progress";
import { method } from "@/data/homepage";
import { cn } from "@/lib/utils";

export function MethodRail() {
  const ref = useRef<HTMLOListElement>(null);
  const reduced = usePrefersReducedMotion();
  const progress = useSmoothedProgress(ref, ["start 0.82", "end 0.55"]);
  const [active, setActive] = useState(reduced ? method.stages.length - 1 : 0);

  useMotionValueEvent(progress, "change", (value) => {
    if (reduced) {
      return;
    }

    setActive(
      Math.min(
        method.stages.length - 1,
        Math.max(0, Math.floor(value * method.stages.length)),
      ),
    );
  });

  return (
    <ol
      ref={ref}
      className="method-rail relative mt-12 border-l border-border pl-6 sm:pl-8"
      data-motion="method-rail"
      data-motion-state={reduced || active >= 3 ? "settled" : "playing"}
    >
      <span
        aria-hidden="true"
        className="absolute top-0 left-[-1px] origin-top bg-primary"
        style={{
          width: 1,
          height: `${((active + 1) / method.stages.length) * 100}%`,
        }}
      />
      {method.stages.map((stage, index) => {
        const current = reduced || active === index;
        const reached = reduced || active >= index;

        return (
          <li
            key={stage.id}
            className={cn(
              "relative pb-10 last:pb-0",
              !reduced &&
                "transition-[opacity,transform] duration-500 ease-out",
              current ? "translate-x-0 opacity-100" : "opacity-55",
            )}
            data-stage={stage.id}
          >
            <span
              aria-hidden="true"
              className={cn(
                "absolute top-1.5 -left-[1.9rem] size-3 rounded-full border bg-background sm:-left-[2.4rem]",
                reached ? "border-primary" : "border-border",
                current && "scale-125 bg-primary",
              )}
            />
            <p
              className={cn(
                "font-mono text-label transition-transform duration-500",
                current ? "scale-110 text-primary" : "text-muted-foreground",
              )}
            >
              {stage.number}
            </p>
            <h3
              className={cn(
                "mt-2 text-xl font-medium tracking-tight",
                !current && "text-muted-foreground",
              )}
            >
              {stage.title}
            </h3>
            <p
              className={cn(
                "mt-3 max-w-xl",
                current ? "text-foreground" : "text-muted-foreground",
              )}
            >
              {stage.body}
            </p>
          </li>
        );
      })}
    </ol>
  );
}
