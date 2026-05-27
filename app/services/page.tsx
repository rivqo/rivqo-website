import Link from "next/link"
import { ArrowRight, CheckCircle2 } from "lucide-react"
import type { Metadata } from "next"

import { Button } from "@/components/ui/button"
import FadeIn from "@/components/animations/fade-in"
import StaggerChildren from "@/components/animations/stagger-children"
import MinimalistPattern from "@/components/minimalist-pattern"
import {
  ParallaxElement,
  FloatingElement,
} from "@/components/parallax-elements"
import {
  CircleShape,
  HexagonShape,
  SquareShape,
} from "@/components/parallax-shapes"
import { cn } from "@/lib/utils"
import { services } from "@/lib/services-data"

export const metadata: Metadata = {
  title: "Services | Rivqo",
  description:
    "Custom development, product design, technical consulting, and ongoing maintenance for teams building software in Africa and beyond.",
}

export default function ServicesPage() {
  return (
    <div className="flex flex-col min-h-screen bg-white">
      <main className="flex-1">
        {/* Hero */}
        <section className="relative w-full py-24 md:py-32 overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-br from-[#00664E] to-[#3EBA9E] opacity-95" />
          <MinimalistPattern className="absolute inset-0 opacity-10" />

          <ParallaxElement
            className="absolute top-20 left-10 text-white/10 w-32 h-32"
            speed={0.3}
            direction="down"
          >
            <CircleShape />
          </ParallaxElement>
          <ParallaxElement
            className="absolute bottom-20 right-10 text-white/10 w-40 h-40"
            speed={0.5}
            direction="up"
          >
            <HexagonShape />
          </ParallaxElement>
          <FloatingElement
            className="absolute top-1/3 right-1/4 text-white/10 w-16 h-16"
            amplitude={15}
            duration={5}
          >
            <SquareShape />
          </FloatingElement>

          <div className="container relative px-4 md:px-6 z-10">
            <div className="flex flex-col items-center text-center max-w-3xl mx-auto space-y-5 mt-10 md:mt-0">
              <FadeIn direction="down">
                <p className="text-sm font-semibold tracking-widest text-white/80 uppercase">
                  Our services
                </p>
              </FadeIn>
              <FadeIn delay={0.1}>
                <h1 className="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl lg:text-6xl text-white">
                  Engineering, design, and judgement — when you need it
                </h1>
              </FadeIn>
              <FadeIn delay={0.2}>
                <p className="max-w-[700px] text-white/90 md:text-xl pt-2">
                  Four practical ways we work with founders and teams. Transparent scope,
                  predictable pricing, and senior people on every engagement.
                </p>
              </FadeIn>
              <FadeIn delay={0.3}>
                <div className="flex flex-col sm:flex-row gap-3 pt-2">
                  <Button asChild size="lg" className="bg-white text-[#00664E] hover:bg-white/90 px-8">
                    <Link href="/contact">Book a consultation</Link>
                  </Button>
                  <Button
                    asChild
                    size="lg"
                    variant="outline"
                    className="border-white text-white bg-[#3EBA9E]/20 hover:bg-[#3EBA9E]/40 px-8"
                  >
                    <Link href="#services">Browse services</Link>
                  </Button>
                </div>
              </FadeIn>
            </div>
          </div>
        </section>

        {/* Service cards */}
        <section id="services" className="relative w-full py-20 md:py-28 bg-white scroll-mt-32">
          <MinimalistPattern className="absolute inset-0 opacity-5" />
          <div className="container relative px-4 md:px-6 z-10">
            <FadeIn>
              <div className="max-w-2xl mx-auto text-center mb-14 space-y-3">
                <p className="text-sm font-semibold tracking-widest text-[#3EBA9E] uppercase">
                  How we help
                </p>
                <h2 className="text-3xl md:text-4xl font-bold text-[#00664E] tracking-tight">
                  Pick the engagement that fits your stage
                </h2>
                <p className="text-gray-600 md:text-lg">
                  Each service is offered as a fixed-scope sprint or an ongoing retainer — whichever
                  matches the work.
                </p>
              </div>
            </FadeIn>

            <StaggerChildren
              className="grid grid-cols-1 md:grid-cols-2 gap-6"
              staggerDelay={0.08}
            >
              {services.map((service) => {
                const Icon = service.icon
                return (
                  <Link
                    key={service.slug}
                    href={`/services/${service.slug}`}
                    className="group relative flex flex-col p-8 rounded-2xl bg-white border border-gray-100 hover:border-[#3EBA9E]/40 hover:shadow-xl transition-all duration-300 overflow-hidden"
                  >
                    <div
                      className={cn(
                        "absolute -top-12 -right-12 h-40 w-40 rounded-full bg-gradient-to-br opacity-10 blur-2xl transition-opacity group-hover:opacity-25",
                        service.accent
                      )}
                    />
                    <div
                      className={cn(
                        "relative inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br shadow-md mb-5 transition-transform group-hover:scale-110 group-hover:rotate-3",
                        service.accent
                      )}
                    >
                      <Icon className="h-7 w-7 text-white" />
                    </div>

                    <h3 className="relative text-2xl font-bold text-[#00664E] mb-2">
                      {service.name}
                    </h3>
                    <p className="relative text-sm text-[#3EBA9E] font-medium mb-4">
                      {service.tagline}
                    </p>
                    <p className="relative text-gray-600 mb-6 leading-relaxed">
                      {service.shortDescription}
                    </p>

                    <div className="relative grid grid-cols-2 gap-4 py-4 border-t border-gray-100 text-sm">
                      <div>
                        <p className="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-1">
                          Starting at
                        </p>
                        <p className="font-semibold text-[#00664E]">{service.startingPrice}</p>
                      </div>
                      <div>
                        <p className="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-1">
                          Timeline
                        </p>
                        <p className="font-semibold text-[#00664E]">{service.typicalTimeline}</p>
                      </div>
                    </div>

                    <div className="relative inline-flex items-center gap-1.5 mt-2 text-sm font-semibold text-[#00664E] group-hover:gap-3 transition-all">
                      Learn more
                      <ArrowRight className="h-4 w-4 transition-transform group-hover:translate-x-1" />
                    </div>
                  </Link>
                )
              })}
            </StaggerChildren>
          </div>
        </section>

        {/* Why work with us */}
        <section className="relative w-full py-20 md:py-28 bg-gray-50">
          <MinimalistPattern className="absolute inset-0 opacity-5" />
          <div className="container relative px-4 md:px-6 z-10">
            <FadeIn>
              <div className="max-w-2xl mx-auto text-center mb-14 space-y-3">
                <p className="text-sm font-semibold tracking-widest text-[#3EBA9E] uppercase">
                  Why Rivqo
                </p>
                <h2 className="text-3xl md:text-4xl font-bold text-[#00664E] tracking-tight">
                  The way we work matters as much as what we deliver
                </h2>
              </div>
            </FadeIn>
            <StaggerChildren
              className="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto"
              staggerDelay={0.1}
            >
              {[
                {
                  title: "Senior team, no juniors hidden in the basement",
                  body: "Every engagement is led by an engineer or designer with 5+ years of shipping product. No bait-and-switch staffing.",
                },
                {
                  title: "Transparent scope and pricing",
                  body: "Fixed-price sprints with a written statement of work. You know what you're paying for before you commit.",
                },
                {
                  title: "Built for African contexts",
                  body: "We design for spotty networks, varied devices, and local payment rails — the realities of the markets we serve.",
                },
              ].map((card) => (
                <div
                  key={card.title}
                  className="p-6 rounded-2xl bg-white border border-gray-100 hover:border-[#3EBA9E]/40 hover:shadow-lg transition-all"
                >
                  <CheckCircle2 className="h-7 w-7 text-[#3EBA9E] mb-4" />
                  <h3 className="font-semibold text-[#00664E] mb-2 leading-snug">{card.title}</h3>
                  <p className="text-sm text-gray-600 leading-relaxed">{card.body}</p>
                </div>
              ))}
            </StaggerChildren>
          </div>
        </section>

        {/* CTA */}
        <section className="relative w-full py-20 md:py-28 overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-br from-[#00664E] to-[#3EBA9E] opacity-95" />
          <MinimalistPattern className="absolute inset-0 opacity-10" />
          <div className="container relative px-4 md:px-6 z-10">
            <div className="flex flex-col items-center text-center max-w-2xl mx-auto space-y-5">
              <FadeIn direction="up">
                <h2 className="text-3xl md:text-4xl font-bold tracking-tight text-white">
                  Not sure which service fits?
                </h2>
              </FadeIn>
              <FadeIn delay={0.15}>
                <p className="text-white/90 md:text-lg">
                  Tell us where you are. We'll recommend the right path — even if it's not us.
                </p>
              </FadeIn>
              <FadeIn delay={0.3}>
                <Button
                  asChild
                  size="lg"
                  className="bg-white text-[#00664E] hover:bg-white/90 px-8 mt-2"
                >
                  <Link href="/contact">
                    Get a recommendation
                    <ArrowRight className="ml-2 h-4 w-4" />
                  </Link>
                </Button>
              </FadeIn>
            </div>
          </div>
        </section>
      </main>
    </div>
  )
}
