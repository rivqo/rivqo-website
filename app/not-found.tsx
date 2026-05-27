import Link from "next/link"
import { ArrowLeft, Home } from "lucide-react"

import { Button } from "@/components/ui/button"
import MinimalistPattern from "@/components/minimalist-pattern"

export default function NotFound() {
  return (
    <main className="relative min-h-[80vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-white via-[#3EBA9E]/5 to-white">
      <MinimalistPattern className="absolute inset-0 opacity-5" />
      <div className="container relative z-10 px-4 md:px-6">
        <div className="max-w-xl mx-auto text-center space-y-6">
          <p className="text-[120px] md:text-[180px] font-bold leading-none bg-gradient-to-br from-[#00664E] to-[#3EBA9E] bg-clip-text text-transparent">
            404
          </p>
          <div className="space-y-3">
            <h1 className="text-3xl md:text-4xl font-bold text-[#00664E] tracking-tight">
              We can't find that page
            </h1>
            <p className="text-gray-600 md:text-lg max-w-md mx-auto">
              The link may be broken, or the page may have moved. Let's get you back on track.
            </p>
          </div>
          <div className="flex flex-col sm:flex-row gap-3 justify-center pt-2">
            <Button asChild className="bg-[#00664E] hover:bg-[#00664E]/90 group">
              <Link href="/">
                <Home className="mr-2 h-4 w-4" />
                Back to home
              </Link>
            </Button>
            <Button
              asChild
              variant="outline"
              className="border-[#00664E] text-[#00664E] hover:bg-[#00664E]/5 group"
            >
              <Link href="/products">
                <ArrowLeft className="mr-2 h-4 w-4 transition-transform group-hover:-translate-x-1" />
                Browse products
              </Link>
            </Button>
          </div>
        </div>
      </div>
    </main>
  )
}
