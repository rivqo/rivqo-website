"use client"

import { usePathname, useSearchParams } from "next/navigation"
import { useEffect, useState } from "react"
import { motion } from "framer-motion"

export default function NavigationProgress() {
  const pathname = usePathname()
  const searchParams = useSearchParams()
  const [isNavigating, setIsNavigating] = useState(false)

  useEffect(() => {
    setIsNavigating(true)
    const timeout = setTimeout(() => setIsNavigating(false), 500)
    return () => clearTimeout(timeout)
  }, [pathname, searchParams])

  return (
    <>
      {isNavigating && (
        <motion.div
          className="fixed top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#00664E] to-[#3EBA9E] z-[100]"
          initial={{ scaleX: 0, transformOrigin: "left" }}
          animate={{ scaleX: 1 }}
          exit={{ scaleX: 1 }}
          transition={{ duration: 0.5 }}
        />
      )}
    </>
  )
}
