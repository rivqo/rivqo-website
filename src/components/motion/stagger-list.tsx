"use client";

import { motion } from "motion/react";
import { useInViewReveal } from "@/components/motion/use-in-view-reveal";
import { motionTokens } from "@/lib/motion";
import { cn } from "@/lib/utils";

type StaggerListProps = {
  items: React.ReactNode[];
  as?: "ul" | "ol";
  className?: string;
  itemClassName?: string;
};

export function StaggerList({
  items,
  as: Tag = "ul",
  className,
  itemClassName,
}: StaggerListProps) {
  const { ref, visible, instant } = useInViewReveal(0.2);
  const List = Tag === "ol" ? motion.ol : motion.ul;

  return (
    <List ref={ref as never} className={className}>
      {items.map((item, index) => (
        <motion.li
          key={index}
          className={cn(itemClassName)}
          initial={false}
          animate={visible ? { opacity: 1, y: 0 } : { opacity: 0, y: 16 }}
          transition={{
            duration: instant || !visible ? 0 : motionTokens.duration.base,
            delay: instant || !visible ? 0 : index * motionTokens.stagger.tight,
            ease: motionTokens.ease.out,
          }}
        >
          {item}
        </motion.li>
      ))}
    </List>
  );
}
