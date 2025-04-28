import Image from "next/image"

export default function ClientLogos() {
  return (
    <div className="flex flex-wrap items-center justify-center gap-8 md:gap-16 py-8">
      <div className="flex items-center justify-center p-4 grayscale transition-all duration-500 hover:grayscale-0 hover:scale-110">
        <Image src="/placeholder.svg?height=40&width=120" alt="Client Logo 1" width={120} height={40} />
      </div>
      <div className="flex items-center justify-center p-4 grayscale transition-all duration-500 hover:grayscale-0 hover:scale-110">
        <Image src="/placeholder.svg?height=40&width=120" alt="Client Logo 2" width={120} height={40} />
      </div>
      <div className="flex items-center justify-center p-4 grayscale transition-all duration-500 hover:grayscale-0 hover:scale-110">
        <Image src="/placeholder.svg?height=40&width=120" alt="Client Logo 3" width={120} height={40} />
      </div>
      <div className="flex items-center justify-center p-4 grayscale transition-all duration-500 hover:grayscale-0 hover:scale-110">
        <Image src="/placeholder.svg?height=40&width=120" alt="Client Logo 4" width={120} height={40} />
      </div>
      <div className="flex items-center justify-center p-4 grayscale transition-all duration-500 hover:grayscale-0 hover:scale-110">
        <Image src="/placeholder.svg?height=40&width=120" alt="Client Logo 5" width={120} height={40} />
      </div>
    </div>
  )
}
