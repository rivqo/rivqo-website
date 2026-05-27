"use client"

import { useEffect, useState } from "react"
import useEmblaCarousel from "embla-carousel-react"
import { ArrowLeft, ArrowRight, Quote, Star } from "lucide-react"

import { cn } from "@/lib/utils"

type Testimonial = {
  id: string
  quote: string
  name: string
  role: string
  company: string
  initials: string
  accent: string
}

const testimonials: readonly Testimonial[] = [
  {
    id: "bloom-lagos",
    quote:
      "Rivqo rebuilt our entire ordering flow in six weeks. We saw a 40% lift in completed orders the first month after launch.",
    name: "Adaeze N.",
    role: "Head of Product",
    company: "Bloom Lagos",
    initials: "AN",
    accent: "from-[#00664E] to-[#3EBA9E]",
  },
  {
    id: "paywave",
    quote:
      "Swiifta cut our bill-payment integration from a six-month roadmap to a sprint. Documentation is the best I've used in the region.",
    name: "Tunde A.",
    role: "Engineering Lead",
    company: "PayWave",
    initials: "TA",
    accent: "from-[#3EBA9E] to-[#00664E]",
  },
  {
    id: "grace-academy",
    quote:
      "Noctua took the chaos out of our fees and attendance. Parents finally get clear updates and our bursar stopped working weekends.",
    name: "Mrs. Chioma E.",
    role: "Principal",
    company: "Grace Academy",
    initials: "CE",
    accent: "from-[#00664E] to-[#3EBA9E]",
  },
  {
    id: "trovo",
    quote:
      "Working with Rivqo felt like having an in-house product team without the headcount. Communication and delivery were both top tier.",
    name: "Femi O.",
    role: "Founder",
    company: "Trovo Logistics",
    initials: "FO",
    accent: "from-[#3EBA9E] to-[#00664E]",
  },
]

const RATING_STARS = ["s1", "s2", "s3", "s4", "s5"] as const

export default function Testimonials() {
  const [emblaRef, emblaApi] = useEmblaCarousel({ loop: true, align: "start" })
  const [selectedIndex, setSelectedIndex] = useState(0)

  useEffect(() => {
    if (!emblaApi) return
    const onSelect = () => setSelectedIndex(emblaApi.selectedScrollSnap())
    emblaApi.on("select", onSelect)
    onSelect()
    return () => {
      emblaApi.off("select", onSelect)
    }
  }, [emblaApi])

  useEffect(() => {
    if (!emblaApi) return
    const interval = setInterval(() => emblaApi.scrollNext(), 6000)
    return () => clearInterval(interval)
  }, [emblaApi])

  return (
    <div className="relative">
      <div className="overflow-hidden" ref={emblaRef}>
        <div className="flex">
          {testimonials.map((t) => (
            <div
              key={t.id}
              className="flex-[0_0_100%] md:flex-[0_0_50%] lg:flex-[0_0_33.333%] min-w-0 px-3"
            >
              <div className="h-full rounded-2xl bg-white border border-gray-100 shadow-sm hover:shadow-lg transition-shadow duration-300 p-6 md:p-8 flex flex-col">
                <Quote className="h-8 w-8 text-[#3EBA9E]/30 mb-4" />
                <p className="text-gray-700 leading-relaxed flex-1 italic">"{t.quote}"</p>
                <div className="mt-6 flex items-center gap-3 pt-6 border-t border-gray-100">
                  <div
                    className={cn(
                      "h-11 w-11 rounded-full bg-gradient-to-br flex items-center justify-center text-white font-semibold shrink-0",
                      t.accent
                    )}
                  >
                    {t.initials}
                  </div>
                  <div className="min-w-0">
                    <p className="font-semibold text-[#00664E] truncate">{t.name}</p>
                    <p className="text-xs text-gray-500 truncate">
                      {t.role} · {t.company}
                    </p>
                  </div>
                  <div className="ml-auto flex gap-0.5">
                    {RATING_STARS.map((star) => (
                      <Star key={star} className="h-3.5 w-3.5 fill-[#3EBA9E] text-[#3EBA9E]" />
                    ))}
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>

      <div className="mt-8 flex items-center justify-center gap-6">
        <button
          type="button"
          onClick={() => emblaApi?.scrollPrev()}
          aria-label="Previous testimonial"
          className="h-10 w-10 rounded-full border border-[#00664E]/20 text-[#00664E] flex items-center justify-center hover:bg-[#00664E] hover:text-white transition-colors"
        >
          <ArrowLeft className="h-4 w-4" />
        </button>

        <div className="flex gap-2">
          {testimonials.map((t, i) => (
            <button
              key={t.id}
              type="button"
              onClick={() => emblaApi?.scrollTo(i)}
              aria-label={`Go to testimonial ${i + 1}`}
              className={cn(
                "h-2 rounded-full transition-all duration-300",
                i === selectedIndex ? "w-8 bg-[#00664E]" : "w-2 bg-[#00664E]/20"
              )}
            />
          ))}
        </div>

        <button
          type="button"
          onClick={() => emblaApi?.scrollNext()}
          aria-label="Next testimonial"
          className="h-10 w-10 rounded-full border border-[#00664E]/20 text-[#00664E] flex items-center justify-center hover:bg-[#00664E] hover:text-white transition-colors"
        >
          <ArrowRight className="h-4 w-4" />
        </button>
      </div>
    </div>
  )
}
