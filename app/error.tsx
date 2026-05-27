"use client"

import { useEffect } from "react"
import Link from "next/link"
import { AlertTriangle, Home, RotateCcw } from "lucide-react"

import { Button } from "@/components/ui/button"
import MinimalistPattern from "@/components/minimalist-pattern"

type GlobalErrorProps = {
  readonly error: Error & { digest?: string }
  readonly reset: () => void
}

export default function GlobalError({ error, reset }: GlobalErrorProps) {
  useEffect(() => {
    console.error(error)
  }, [error])

  return (
    <main className="relative min-h-[80vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-white via-red-50/40 to-white">
      <MinimalistPattern className="absolute inset-0 opacity-5" />
      <div className="container relative z-10 px-4 md:px-6">
        <div className="max-w-xl mx-auto text-center space-y-6">
          <div className="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-red-100 mx-auto">
            <AlertTriangle className="h-8 w-8 text-red-600" />
          </div>
          <div className="space-y-3">
            <h1 className="text-3xl md:text-4xl font-bold text-[#00664E] tracking-tight">
              Something went wrong
            </h1>
            <p className="text-gray-600 md:text-lg max-w-md mx-auto">
              An unexpected error occurred. Our team has been notified. You can try again or head
              back home.
            </p>
            {error.digest && (
              <p className="text-xs text-gray-400 font-mono">Reference: {error.digest}</p>
            )}
          </div>
          <div className="flex flex-col sm:flex-row gap-3 justify-center pt-2">
            <Button onClick={() => reset()} className="bg-[#00664E] hover:bg-[#00664E]/90">
              <RotateCcw className="mr-2 h-4 w-4" />
              Try again
            </Button>
            <Button
              asChild
              variant="outline"
              className="border-[#00664E] text-[#00664E] hover:bg-[#00664E]/5"
            >
              <Link href="/">
                <Home className="mr-2 h-4 w-4" />
                Back to home
              </Link>
            </Button>
          </div>
        </div>
      </div>
    </main>
  )
}
