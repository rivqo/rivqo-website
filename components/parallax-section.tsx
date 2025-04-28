"use client"

import { useRef, type ReactNode } from "react"
import { motion, useScroll, useTransform } from "framer-motion"
import { cn } from "@/lib/utils"

interface ParallaxSectionProps {
  children: ReactNode
  className?: string
  bgClassName?: string
  speed?: number
  direction?: "up" | "down" | "left" | "right"
  overflow?: "visible" | "hidden"
}

export default function ParallaxSection({
  children,
  className,
  bgClassName,
  speed = 0.5,
  direction = "up",
  overflow = "hidden",
}: ParallaxSectionProps) {
  const ref = useRef<HTMLDivElement>(null)
  const { scrollYProgress } = useScroll({
    target: ref,
    offset: ["start end", "end start"],
  })

  // Calculate transform based on direction
  const value = 100 * speed
  const upTransform = useTransform(scrollYProgress, [0, 1], [`0%`, `-${value}%`])
  const downTransform = useTransform(scrollYProgress, [0, 1], [`0%`, `${value}%`])
  const leftTransform = useTransform(scrollYProgress, [0, 1], [`0%`, `-${value}%`])
  const rightTransform = useTransform(scrollYProgress, [0, 1], [`0%`, `${value}%`])

  const getTransform = () => {
    switch (direction) {
      case "up":
        return upTransform
      case "down":
        return downTransform
      case "left":
        return leftTransform
      case "right":
        return rightTransform
      default:
        return upTransform
    }
  }

  const transform = getTransform()
  const isVertical = direction === "up" || direction === "down"
  const transformProp = isVertical ? { y: transform } : { x: transform }

  return (
    <div ref={ref} className={cn("relative", overflow === "hidden" ? "overflow-hidden" : "", className)}>
      <motion.div  className={cn("absolute inset-0 z-0", bgClassName)} />
      <div className="relative z-10">{children}</div>
    </div>
  )
}
