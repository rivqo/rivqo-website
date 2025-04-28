import { cn } from "@/lib/utils"

interface MinimalistPatternProps {
  className?: string
}

export default function MinimalistPattern({ className }: MinimalistPatternProps) {
  return (
    <div className={cn("pointer-events-none", className)}>
      <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" className="absolute inset-0">
        <defs>
          <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
            <circle cx="2" cy="2" r="1" fill="currentColor" />
          </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#grid-pattern)" />
      </svg>
    </div>
  )
}
