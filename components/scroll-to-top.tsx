"use client"

import { useState, useEffect } from "react"
import { motion, AnimatePresence } from "framer-motion"
import { ChevronUp } from "lucide-react"
import { cn } from "@/lib/utils"

interface ScrollToTopProps {
  className?: string
  showAtPixels?: number
}

export default function ScrollToTop({ className, showAtPixels = 300 }: ScrollToTopProps) {
  const [isVisible, setIsVisible] = useState(false)

  useEffect(() => {
    const toggleVisibility = () => {
      if (window.scrollY > showAtPixels) {
        setIsVisible(true)
      } else {
        setIsVisible(false)
      }
    }

    window.addEventListener("scroll", toggleVisibility)
    return () => window.removeEventListener("scroll", toggleVisibility)
  }, [showAtPixels])

  const scrollToTop = () => {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    })
  }

  return (
    <AnimatePresence>
      {isVisible && (
        <motion.button
          initial={{ opacity: 0, scale: 0.5 }}
          animate={{ opacity: 1, scale: 1 }}
          exit={{ opacity: 0, scale: 0.5 }}
          transition={{ duration: 0.3 }}
          onClick={scrollToTop}
          className={cn(
            "fixed bottom-8 right-8 z-50 flex h-12 w-12 items-center justify-center rounded-full bg-[#00664E] text-white shadow-lg transition-all duration-300 hover:bg-[#3EBA9E] focus:outline-none focus:ring-2 focus:ring-[#3EBA9E] focus:ring-offset-2",
            className,
          )}
          aria-label="Scroll to top"
        >
          <ChevronUp className="h-6 w-6" />
          <span className="sr-only">Scroll to top</span>
          <motion.div
            className="absolute inset-0 rounded-full bg-[#3EBA9E] opacity-30"
            animate={{ scale: [1, 1.2, 1] }}
            transition={{ duration: 2, repeat: Number.POSITIVE_INFINITY }}
          />
        </motion.button>
      )}
    </AnimatePresence>
  )
}
