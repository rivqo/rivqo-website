"use client";

import { motion } from "motion/react";
import { useInViewReveal } from "@/components/motion/use-in-view-reveal";
import { StatusLabel } from "@/components/ui/status-label";
import { motionTokens } from "@/lib/motion";
import type { WorkflowNode } from "@/types/pages";

type WorkflowBoardProps = {
  title?: string;
  nodes: WorkflowNode[];
};

export function WorkflowBoard({
  title = "Sample operating trail",
  nodes,
}: WorkflowBoardProps) {
  const { ref, visible, instant } = useInViewReveal<HTMLOListElement>(0.24);

  return (
    <div
      className="workflow-board border border-border bg-background"
      data-motion="workflow-board"
      data-motion-state={visible || instant ? "settled" : "pending"}
    >
      <p className="border-b border-border px-4 py-3 font-mono text-label text-muted-foreground">
        {title}
      </p>
      <ol ref={ref} className="divide-y divide-border">
        {nodes.map((node, index) => (
          <motion.li
            key={`${node.code}-${node.label}`}
            className="workflow-row flex items-start justify-between gap-4 px-4 py-3"
            initial={false}
            animate={visible ? { opacity: 1, x: 0 } : { opacity: 0, x: 22 }}
            transition={{
              duration: instant || !visible ? 0 : motionTokens.duration.base,
              delay:
                instant || !visible ? 0 : index * motionTokens.stagger.base,
              ease: motionTokens.ease.out,
            }}
          >
            <div className="min-w-0">
              <p className="font-mono text-label text-muted-foreground">
                {node.code}
              </p>
              <p className="mt-1 text-sm font-medium tracking-tight">
                {node.label}
              </p>
            </div>
            <StatusLabel tone={node.tone}>{node.status}</StatusLabel>
          </motion.li>
        ))}
      </ol>
    </div>
  );
}
