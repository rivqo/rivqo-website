"use client"

import type React from "react"

import { useRef } from "react"
import { motion, useScroll, useTransform } from "framer-motion"
import { cn } from "@/lib/utils"

interface ParallaxElementProps {
  className?: string
  speed?: number
  direction?: "up" | "down" | "left" | "right"
  children: React.ReactNode
  delay?: number
}

export function ParallaxElement({
  className,
  speed = 0.5,
  direction = "up",
  children,
  delay = 0,
}: ParallaxElementProps) {
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
    <motion.div
      ref={ref}
      style={transformProp}
      initial={{ opacity: 0 }}
      animate={{ opacity: 1 }}
      transition={{ duration: 0.5, delay }}
      className={className}
    >
      {children}
    </motion.div>
  )
}

interface FloatingElementProps {
  className?: string
  amplitude?: number
  duration?: number
  delay?: number
  children: React.ReactNode
}

export function FloatingElement({
  className,
  amplitude = 10,
  duration = 4,
  delay = 0,
  children,
}: FloatingElementProps) {
  return (
    <motion.div
      className={className}
      animate={{ y: [0, amplitude, 0] }}
      transition={{
        duration,
        repeat: Number.POSITIVE_INFINITY,
        repeatType: "reverse",
        ease: "easeInOut",
        delay,
      }}
    >
      {children}
    </motion.div>
  )
}

interface RotatingElementProps {
  className?: string
  degrees?: number
  duration?: number
  delay?: number
  children: React.ReactNode
}

export function RotatingElement({
  className,
  degrees = 360,
  duration = 20,
  delay = 0,
  children,
}: RotatingElementProps) {
  return (
    <motion.div
      className={cn("origin-center", className)}
      animate={{ rotate: degrees }}
      transition={{
        duration,
        repeat: Number.POSITIVE_INFINITY,
        ease: "linear",
        delay,
      }}
    >
      {children}
    </motion.div>
  )
}
