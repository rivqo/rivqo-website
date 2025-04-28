"use client"

import { motion } from "framer-motion"
import { cn } from "@/lib/utils"

interface LoaderProps {
  className?: string
  size?: "small" | "medium" | "large" | "full"
}

export default function Loader({ className, size = "medium" }: LoaderProps) {
  const sizeClasses = {
    small: "w-8 h-8",
    medium: "w-16 h-16",
    large: "w-24 h-24",
    full: "w-full h-full max-w-[200px] max-h-[200px]",
  }

  const circleVariants = {
    hidden: { pathLength: 0, opacity: 0 },
    visible: (i: number) => {
      const delay = i * 0.5
      return {
        pathLength: 1,
        opacity: 1,
        transition: {
          pathLength: { delay, type: "spring", duration: 1.5, bounce: 0 },
          opacity: { delay, duration: 0.01 },
        },
      }
    },
  }

  const pulseVariants = {
    initial: { scale: 0.8, opacity: 0 },
    animate: {
      scale: 1,
      opacity: [0, 0.5, 0],
      transition: {
        duration: 2,
        repeat: Number.POSITIVE_INFINITY,
        repeatType: "loop" as const,
      },
    },
  }

  return (
    <div className={cn("flex items-center justify-center", className)}>
      <div className="relative">
        <motion.div
          initial="initial"
          animate="animate"
          variants={pulseVariants}
          className={cn("absolute inset-0 rounded-full bg-[#3EBA9E]/20", sizeClasses[size])}
        />
        <svg
          className={cn("transform -rotate-90", sizeClasses[size])}
          viewBox="0 0 100 100"
          xmlns="http://www.w3.org/2000/svg"
        >
          <motion.circle
            cx="50"
            cy="50"
            r="30"
            stroke="#3EBA9E"
            strokeWidth="4"
            fill="none"
            custom={1}
            variants={circleVariants}
            initial="hidden"
            animate="visible"
          />
          <motion.circle
            cx="50"
            cy="50"
            r="40"
            stroke="#00664E"
            strokeWidth="4"
            fill="none"
            custom={0}
            variants={circleVariants}
            initial="hidden"
            animate="visible"
          />
          <motion.path
            d="M 50,30 L 50,50 L 65,65"
            fill="none"
            stroke="#00664E"
            strokeWidth="4"
            strokeLinecap="round"
            initial={{ pathLength: 0, opacity: 0 }}
            animate={{
              pathLength: 1,
              opacity: 1,
              transition: { delay: 1, duration: 0.75, ease: "easeInOut" },
            }}
          />
        </svg>
      </div>
    </div>
  )
}
