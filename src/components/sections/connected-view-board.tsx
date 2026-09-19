"use client";

import { useMotionValueEvent } from "motion/react";
import { useRef, useState } from "react";
import { useDesktop } from "@/components/motion/use-desktop";
import { usePrefersReducedMotion } from "@/components/motion/use-prefers-reduced-motion";
import { useSmoothedProgress } from "@/components/motion/use-smoothed-progress";
import { connectedView } from "@/data/homepage";
import { cn } from "@/lib/utils";

const sourceOrigins = [
  { x: -14, y: -12 },
  { x: 16, y: -8 },
  { x: -10, y: 12 },
  { x: 12, y: 14 },
  { x: -16, y: 4 },
  { x: 10, y: -14 },
];

export function ConnectedViewBoard() {
  const storyRef = useRef<HTMLDivElement>(null);
  const boardRef = useRef<HTMLDivElement>(null);
  const reduced = usePrefersReducedMotion();
  const desktop = useDesktop();
  const progress = useSmoothedProgress(
    desktop ? storyRef : boardRef,
    desktop ? ["start start", "end end"] : ["start 0.85", "end 0.4"],
  );
  const [phase, setPhase] = useState(reduced ? 1 : 0);

  useMotionValueEvent(progress, "change", (value) => {
    if (reduced) {
      return;
    }

    setPhase(value);
  });

  const gather = reduced ? 1 : Math.min(1, Math.max(0, (phase - 0.08) / 0.42));
  const connect = reduced ? 1 : Math.min(1, Math.max(0, (phase - 0.38) / 0.28));
  const resolve = reduced ? 1 : Math.min(1, Math.max(0, (phase - 0.62) / 0.3));
  const settled = reduced || phase >= 0.92;

  return (
    <div ref={storyRef} className="connected-story mt-12">
      <div
        ref={boardRef}
        className="connected-sticky"
        data-motion="connected-view"
        data-motion-state={settled ? "settled" : "playing"}
      >
        <div className="connected-view grid gap-8 xl:grid-cols-[minmax(0,1fr)_auto_minmax(0,1fr)] xl:items-center">
          <div data-motion="sources">
            <p className="font-mono text-label text-muted-foreground">Before</p>
            <ul className="mt-4 flex flex-wrap gap-2 overflow-visible py-2">
              {connectedView.before.map((item, index) => {
                const origin = sourceOrigins[index] ?? sourceOrigins[0];
                const x = (1 - gather) * origin.x;
                const y = (1 - gather) * origin.y;

                return (
                  <li
                    key={item.id}
                    className={cn(
                      "source-chip px-3 py-2 text-sm",
                      gather > 0.7 && "border-primary/40",
                    )}
                    data-source={item.id}
                    style={{
                      transform: `translate(${x}px, ${y}px)`,
                    }}
                  >
                    {item.label}
                  </li>
                );
              })}
            </ul>
          </div>

          <div
            aria-hidden="true"
            className="relative hidden h-24 items-center text-primary xl:flex"
            data-motion="connector"
          >
            <svg
              width="88"
              height="24"
              viewBox="0 0 88 24"
              className="overflow-visible"
            >
              <line
                x1="0"
                y1="12"
                x2="88"
                y2="12"
                stroke="currentColor"
                strokeWidth="1.5"
                strokeDasharray="88"
                strokeDashoffset={88 * (1 - connect)}
              />
            </svg>
            <span
              className="absolute top-1/2 font-mono text-[10px] tracking-tight text-primary"
              style={{
                left: `${8 + connect * 64}px`,
                opacity: connect > 0.08 && connect < 0.96 ? 1 : 0,
                transform: "translateY(-50%)",
              }}
            >
              PR-184
            </span>
          </div>

          <div
            className={cn(
              "border border-border bg-background p-5 transition-[border-color,transform,opacity] duration-500",
              connect > 0.5 && "border-primary/40",
            )}
            data-motion="operating-view"
            style={{
              transform: `translateY(${(1 - resolve) * 28}px)`,
              opacity: 0.45 + resolve * 0.55,
            }}
          >
            <p className="font-mono text-label text-primary">After</p>
            <p className="mt-2 font-medium tracking-tight">
              Rivqo operating view
            </p>
            <ul className="mt-5 divide-y divide-border border-t border-border">
              {connectedView.after.map((item, index) => {
                const shown =
                  reduced ||
                  resolve >= (index + 1) / connectedView.after.length;

                return (
                  <li
                    key={item.id}
                    className={cn(
                      "operating-item border-x-0 border-t-0 px-0 py-3",
                      shown ? "text-foreground" : "text-muted-foreground",
                    )}
                    data-target={item.id}
                    data-state={shown ? "reached" : "pending"}
                  >
                    {item.label}
                  </li>
                );
              })}
            </ul>
          </div>
        </div>
      </div>
    </div>
  );
}
