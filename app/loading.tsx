import Loader from "@/components/loader"

export default function Loading() {
  return (
    <div className="fixed inset-0 flex items-center justify-center bg-white/80 backdrop-blur-sm z-50">
      <div className="text-center">
        <Loader size="large" />
        <p className="mt-4 text-lg font-medium text-[#00664E] animate-pulse">Loading Rivqo...</p>
      </div>
    </div>
  )
}
