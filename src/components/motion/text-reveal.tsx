"use client";

import { animate, motion } from "motion/react";
import { useLayoutEffect, useRef } from "react";
import { useInViewReveal } from "@/components/motion/use-in-view-reveal";
import { usePrefersReducedMotion } from "@/components/motion/use-prefers-reduced-motion";
import { motionTokens, readEntranceMode } from "@/lib/motion";
import { cn } from "@/lib/utils";

type TextTag = "h1" | "h2" | "h3" | "p" | "span";

type TextRevealProps = {
  as?: TextTag;
  id?: string;
  lines: string[];
  className?: string;
  delay?: number;
  distance?: number;
};

export function TextReveal({
  as: Tag = "p",
  id,
  lines,
  className,
  delay = 0,
  distance = motionTokens.reveal.heading,
}: TextRevealProps) {
  const { ref, visible, instant } = useInViewReveal(0.2);

  return (
    <Tag id={id} className={className} ref={ref as never}>
      {lines.map((line, index) => (
        <span key={line} className="block overflow-hidden">
          <motion.span
            className="block"
            initial={false}
            animate={
              visible ? { y: 0, opacity: 1 } : { y: distance, opacity: 0 }
            }
            transition={{
              duration: instant || !visible ? 0 : motionTokens.duration.slow,
              delay:
                instant || !visible
                  ? 0
                  : delay + index * motionTokens.stagger.line,
              ease: motionTokens.ease.out,
            }}
          >
            {line}
          </motion.span>
        </span>
      ))}
    </Tag>
  );
}

type CopyRevealProps = {
  children: React.ReactNode;
  className?: string;
  delay?: number;
};

export function HeroHeadline({
  id,
  lines,
  className,
}: {
  id: string;
  lines: string[];
  className?: string;
}) {
  const refs = useRef<Array<HTMLSpanElement | null>>([]);
  const reduced = usePrefersReducedMotion();

  useLayoutEffect(() => {
    if (reduced) {
      return;
    }

    const mode = readEntranceMode();
    if (mode !== "full" && mode !== "short") {
      refs.current.forEach((node) => {
        if (node) {
          node.style.opacity = "1";
          node.style.transform = "none";
        }
      });
      return;
    }

    const short = mode === "short";
    const controls = refs.current.map((node, index) => {
      if (!node) {
        return null;
      }

      if (index === 0) {
        node.style.opacity = "1";
        node.style.transform = "none";
        return null;
      }

      return animate(
        node,
        { y: 0, opacity: 1 },
        {
          delay: short
            ? 0.06 + (index - 1) * 0.04
            : 0.16 + (index - 1) * motionTokens.stagger.line,
          duration: short
            ? motionTokens.duration.shortEntrance
            : motionTokens.duration.slow,
          ease: motionTokens.ease.out,
        },
      );
    });

    return () => {
      controls.forEach((control) => control?.stop());
    };
  }, [reduced]);

  return (
    <h1 id={id} className={className}>
      {lines.map((line, index) => (
        <span key={line} className="block overflow-hidden">
          <span
            ref={(node) => {
              refs.current[index] = node;
            }}
            className={cn(
              "block",
              !reduced && index > 0 && "hero-line-pending",
            )}
          >
            {line}
          </span>
        </span>
      ))}
    </h1>
  );
}

export function CopyReveal({
  children,
  className,
  delay = 0,
}: CopyRevealProps) {
  const { ref, visible, instant } = useInViewReveal(0.2);

  return (
    <motion.div
      ref={ref}
      className={className}
      initial={false}
      animate={
        visible
          ? { y: 0, opacity: 1 }
          : { y: motionTokens.reveal.body, opacity: 0 }
      }
      transition={{
        duration: instant || !visible ? 0 : motionTokens.duration.base,
        delay: instant || !visible ? 0 : delay,
        ease: motionTokens.ease.out,
      }}
    >
      {children}
    </motion.div>
  );
}
