export function CircleShape({ className }: { className?: string }) {
  return (
    <div className={className}>
      <svg width="100%" height="100%" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="50" fill="currentColor" />
      </svg>
    </div>
  )
}

export function SquareShape({ className }: { className?: string }) {
  return (
    <div className={className}>
      <svg width="100%" height="100%" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect width="100" height="100" rx="10" fill="currentColor" />
      </svg>
    </div>
  )
}

export function TriangleShape({ className }: { className?: string }) {
  return (
    <div className={className}>
      <svg width="100%" height="100%" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M50 0L100 100H0L50 0Z" fill="currentColor" />
      </svg>
    </div>
  )
}

export function DonutShape({ className }: { className?: string }) {
  return (
    <div className={className}>
      <svg width="100%" height="100%" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="50" cy="50" r="50" fill="currentColor" />
        <circle cx="50" cy="50" r="25" fill="white" />
      </svg>
    </div>
  )
}

export function HexagonShape({ className }: { className?: string }) {
  return (
    <div className={className}>
      <svg width="100%" height="100%" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M50 0L93.3013 25V75L50 100L6.69873 75V25L50 0Z" fill="currentColor" />
      </svg>
    </div>
  )
}

export function PlusShape({ className }: { className?: string }) {
  return (
    <div className={className}>
      <svg width="100%" height="100%" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="35" y="0" width="30" height="100" rx="5" fill="currentColor" />
        <rect x="0" y="35" width="100" height="30" rx="5" fill="currentColor" />
      </svg>
    </div>
  )
}

export function WaveShape({ className }: { className?: string }) {
  return (
    <div className={className}>
      <svg width="100%" height="100%" viewBox="0 0 100 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M0 10C10 5 15 15 25 10C35 5 40 15 50 10C60 5 65 15 75 10C85 5 90 15 100 10V20H0V10Z"
          fill="currentColor"
        />
      </svg>
    </div>
  )
}
