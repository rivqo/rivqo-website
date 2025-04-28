import Loader from "@/components/loader"

export default function ProductsLoading() {
  return (
    <div className="min-h-[70vh] flex items-center justify-center">
      <div className="text-center">
        <Loader size="large" />
        <p className="mt-4 text-lg font-medium text-[#00664E] animate-pulse">Loading Products...</p>
      </div>
    </div>
  )
}
