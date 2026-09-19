"use client";

import { useMotionValueEvent } from "motion/react";
import { useRef, useState, type RefObject } from "react";
import { StatusLabel } from "@/components/ui/status-label";
import { useDesktop } from "@/components/motion/use-desktop";
import { usePrefersReducedMotion } from "@/components/motion/use-prefers-reduced-motion";
import { useSmoothedProgress } from "@/components/motion/use-smoothed-progress";
import { flowNodes } from "@/data/homepage";
import { cn } from "@/lib/utils";

type OperationalFlowProps = {
  progressSource?: RefObject<HTMLElement | null>;
};

export function OperationalFlow({ progressSource }: OperationalFlowProps) {
  const localRef = useRef<HTMLDivElement>(null);
  const reduced = usePrefersReducedMotion();
  const desktop = useDesktop();
  const target = desktop && progressSource ? progressSource : localRef;
  const progress = useSmoothedProgress(
    target,
    desktop ? ["start start", "end end"] : ["start 0.88", "end 0.35"],
  );
  const [step, setStep] = useState(reduced ? flowNodes.length - 1 : 0);
  const settled = reduced || step >= flowNodes.length - 1;

  useMotionValueEvent(progress, "change", (value) => {
    if (reduced) {
      return;
    }

    const next = Math.min(
      flowNodes.length - 1,
      Math.max(0, Math.floor(value * flowNodes.length)),
    );
    setStep(next);
  });

  return (
    <div
      ref={localRef}
      className="flow-board relative overflow-hidden border border-border bg-background/90 p-3 sm:p-4"
      data-motion="operational-flow"
      data-motion-state={settled ? "settled" : "playing"}
      aria-label="Operational control flow from purchase request to management view"
    >
      <div
        aria-hidden="true"
        className="pointer-events-none absolute inset-x-6 top-0 h-px origin-left bg-primary/50"
        style={{
          transform: `scaleX(${reduced ? 1 : (step + 1) / flowNodes.length})`,
        }}
      />

      <div className="mb-4 flex flex-col gap-2 border-b border-border pb-3 sm:flex-row sm:items-center sm:justify-between">
        <p className="font-mono text-label text-muted-foreground">
          Operating view / PR-184
        </p>
        <StatusLabel tone="warning">Exceptions open</StatusLabel>
      </div>

      <ol className="flow-rail space-y-0">
        {flowNodes.map((node, index) => {
          const reached = reduced || step >= index;
          const current = !reduced && step === index;
          const exception = node.tone === "warning" || node.tone === "critical";
          const connectorOn = reduced || step >= index;

          return (
            <li
              key={node.id}
              className="flow-step relative"
              data-motion="flow-node"
              data-node={node.id}
              data-state={current ? "current" : reached ? "reached" : "pending"}
            >
              {index > 0 ? (
                <span
                  aria-hidden="true"
                  className="flow-link relative mx-auto block h-5 w-px overflow-hidden bg-border"
                  data-motion="flow-link"
                >
                  <span
                    className={cn(
                      "absolute inset-0 origin-top bg-primary",
                      connectorOn ? "scale-y-100" : "scale-y-0",
                      !reduced && "transition-transform duration-500 ease-out",
                    )}
                  />
                </span>
              ) : null}
              <article
                className={cn(
                  "flow-node grid gap-2 p-3 sm:grid-cols-[5.5rem_minmax(0,1fr)_auto] sm:items-center",
                  !reduced &&
                    "transition-[transform,border-color,background-color,opacity] duration-500 ease-out",
                  reached && "border-primary/35",
                  current && "z-10",
                  current && !exception && "border-primary bg-muted/70",
                  current &&
                    exception &&
                    "border-warning bg-warning-surface/70",
                  !reached && "opacity-55",
                )}
              >
                <p className="font-mono text-label text-muted-foreground">
                  {node.code}
                </p>
                <p className="text-base font-medium tracking-tight">
                  {node.label}
                </p>
                <StatusLabel tone={node.tone}>{node.status}</StatusLabel>
              </article>
            </li>
          );
        })}
      </ol>
    </div>
  );
}
