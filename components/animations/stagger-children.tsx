"use client"

import type React from "react"

import { useRef, useEffect, useState, Children, cloneElement, isValidElement } from "react"
import { cn } from "@/lib/utils"

interface StaggerChildrenProps {
  children: React.ReactNode
  className?: string
  staggerDelay?: number
  initialDelay?: number
  threshold?: number
  once?: boolean
}

export default function StaggerChildren({
  children,
  className,
  staggerDelay = 0.1,
  initialDelay = 0,
  threshold = 0.1,
  once = true,
}: StaggerChildrenProps) {
  const [isVisible, setIsVisible] = useState(false)
  const ref = useRef<HTMLDivElement>(null)

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          setIsVisible(true)
          if (once && ref.current) {
            observer.unobserve(ref.current)
          }
        } else if (!once) {
          setIsVisible(false)
        }
      },
      {
        threshold,
        rootMargin: "0px",
      },
    )

    const currentRef = ref.current
    if (currentRef) {
      observer.observe(currentRef)
    }

    return () => {
      if (currentRef) {
        observer.unobserve(currentRef)
      }
    }
  }, [once, threshold])

  const childrenWithStagger = Children.map(children, (child, index) => {
    if (isValidElement(child)) {
      return cloneElement(child, {
        style: {
          ...child.props.style,
          opacity: isVisible ? 1 : 0,
          transform: isVisible ? "none" : "translateY(20px)",
          transition: `opacity 0.5s ease, transform 0.5s ease`,
          transitionDelay: `${initialDelay + index * staggerDelay}s`,
        },
      })
    }
    return child
  })

  return (
    <div ref={ref} className={cn(className)}>
      {childrenWithStagger}
    </div>
  )
}
