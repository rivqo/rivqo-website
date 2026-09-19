"use client";

import { motion } from "motion/react";
import { useInViewReveal } from "@/components/motion/use-in-view-reveal";
import { problems } from "@/data/homepage";
import { motionTokens } from "@/lib/motion";
import { cn } from "@/lib/utils";

const offsets = [
  { x: -48, y: 36, rotate: -1.2 },
  { x: 42, y: 28, rotate: 1.1 },
  { x: -36, y: 52, rotate: -0.8 },
  { x: 38, y: 44, rotate: 0.9 },
  { x: -28, y: 40, rotate: -0.6 },
  { x: 22, y: 56, rotate: 0.4 },
];

export function ProblemBoard() {
  const { ref, visible, instant } = useInViewReveal<HTMLUListElement>("some");

  return (
    <ul
      ref={ref}
      className="problem-board mt-12 grid grid-cols-1 gap-px border border-border bg-border sm:grid-cols-2 lg:grid-cols-12"
      data-motion="problem-board"
      data-motion-state="settled"
    >
      {problems.items.map((item, index) => {
        const offset = offsets[index] ?? offsets[0];

        return (
          <motion.li
            key={item.title}
            className={cn(
              "problem-item group relative bg-background p-5",
              index === 0 && "lg:col-span-7",
              index === 1 && "lg:col-span-5",
              index === 5 && "lg:col-span-12",
              index > 1 && index < 5 && "lg:col-span-4",
            )}
            data-motion="problem-item"
            initial={false}
            animate={
              visible
                ? { opacity: 1, x: 0, y: 0, rotate: 0 }
                : {
                    opacity: 0,
                    x: offset.x,
                    y: offset.y,
                    rotate: offset.rotate,
                  }
            }
            transition={{
              duration: instant || !visible ? 0 : motionTokens.duration.slow,
              delay:
                instant || !visible
                  ? 0
                  : 0.08 + index * motionTokens.stagger.base,
              ease: motionTokens.ease.out,
            }}
          >
            <span
              aria-hidden="true"
              className="absolute top-5 right-5 size-2 rounded-full bg-warning transition-transform duration-400 ease-out group-hover:scale-150"
            />
            <h3 className="pr-6 text-xl font-medium tracking-tight">
              {item.title}
            </h3>
            <p className="mt-3 max-w-sm text-muted-foreground">{item.detail}</p>
          </motion.li>
        );
      })}
    </ul>
  );
}
