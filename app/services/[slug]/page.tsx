import Link from "next/link"
import { notFound } from "next/navigation"
import type { Metadata } from "next"
import { ArrowLeft, ArrowRight, Check, Clock, DollarSign, Target } from "lucide-react"

import { Button } from "@/components/ui/button"
import FadeIn from "@/components/animations/fade-in"
import StaggerChildren from "@/components/animations/stagger-children"
import MinimalistPattern from "@/components/minimalist-pattern"
import FaqSection from "@/components/faq-section"
import { cn } from "@/lib/utils"
import {
  getAllServiceSlugs,
  getServiceBySlug,
  services,
} from "@/lib/services-data"

type Params = Promise<{ slug: string }>

interface ServiceDetailPageProps {
  readonly params: Params
}

export async function generateStaticParams() {
  return getAllServiceSlugs().map((slug) => ({ slug }))
}

export async function generateMetadata({ params }: ServiceDetailPageProps): Promise<Metadata> {
  const { slug } = await params
  const service = getServiceBySlug(slug)
  if (!service) {
    return { title: "Service not found | Rivqo" }
  }
  return {
    title: `${service.name} | Rivqo`,
    description: service.shortDescription,
  }
}

export default async function ServiceDetailPage({ params }: ServiceDetailPageProps) {
  const { slug } = await params
  const service = getServiceBySlug(slug)

  if (!service) {
    notFound()
  }

  const Icon = service.icon
  const otherServices = services.filter((s) => s.slug !== service.slug)
  const faqItems = service.faqs.map((f, i) => ({
    id: `${service.slug}-faq-${i}`,
    question: f.question,
    answer: f.answer,
  }))

  return (
    <div className="flex flex-col min-h-screen bg-white">
      <main className="flex-1">
        {/* Hero */}
        <section className="relative w-full py-24 md:py-32 overflow-hidden">
          <div
            className={cn(
              "absolute inset-0 bg-gradient-to-br opacity-95",
              service.accent
            )}
          />
          <MinimalistPattern className="absolute inset-0 opacity-10" />

          <div className="container relative px-4 md:px-6 z-10">
            <div className="max-w-3xl mx-auto mt-10 md:mt-0">
              <FadeIn direction="down">
                <Link
                  href="/services"
                  className="inline-flex items-center gap-1.5 text-sm font-medium text-white/80 hover:text-white transition-colors mb-6"
                >
                  <ArrowLeft className="h-4 w-4" />
                  All services
                </Link>
              </FadeIn>

              <FadeIn delay={0.05}>
                <div className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/15 backdrop-blur text-white text-xs font-semibold tracking-wider uppercase mb-5">
                  <Icon className="h-3.5 w-3.5" />
                  {service.name}
                </div>
              </FadeIn>

              <FadeIn delay={0.1}>
                <h1 className="text-3xl font-bold tracking-tight sm:text-4xl md:text-5xl lg:text-6xl text-white leading-tight">
                  {service.tagline}
                </h1>
              </FadeIn>

              <FadeIn delay={0.2}>
                <p className="mt-5 text-white/90 md:text-xl max-w-2xl leading-relaxed">
                  {service.longDescription}
                </p>
              </FadeIn>

              <FadeIn delay={0.3}>
                <div className="flex flex-col sm:flex-row gap-3 mt-8">
                  <Button asChild size="lg" className="bg-white text-[#00664E] hover:bg-white/90 px-8">
                    <Link href="/contact">
                      Book a consultation
                      <ArrowRight className="ml-2 h-4 w-4" />
                    </Link>
                  </Button>
                  <Button
                    asChild
                    size="lg"
                    variant="outline"
                    className="border-white text-white bg-white/10 hover:bg-white/20 px-8"
                  >
                    <Link href="#process">See how we work</Link>
                  </Button>
                </div>
              </FadeIn>
            </div>
          </div>
        </section>

        {/* At-a-glance */}
        <section className="relative w-full py-12 md:py-16 bg-gray-50 border-b border-gray-100">
          <div className="container px-4 md:px-6">
            <StaggerChildren
              className="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-5xl mx-auto"
              staggerDelay={0.1}
            >
              <InfoCard
                icon={DollarSign}
                label="Starting price"
                value={service.startingPrice}
              />
              <InfoCard
                icon={Clock}
                label="Typical timeline"
                value={service.typicalTimeline}
              />
              <InfoCard icon={Target} label="Best for" value={service.bestFor} />
            </StaggerChildren>
          </div>
        </section>

        {/* Deliverables */}
        <section className="relative w-full py-20 md:py-28 bg-white">
          <div className="container px-4 md:px-6">
            <div className="grid lg:grid-cols-2 gap-12 lg:gap-20 items-start max-w-6xl mx-auto">
              <FadeIn>
                <div className="space-y-4">
                  <p className="text-sm font-semibold tracking-widest text-[#3EBA9E] uppercase">
                    What you get
                  </p>
                  <h2 className="text-3xl md:text-4xl font-bold text-[#00664E] tracking-tight">
                    Concrete deliverables, not vague promises
                  </h2>
                  <p className="text-gray-600 md:text-lg leading-relaxed">
                    Every {service.name.toLowerCase()} engagement ships these artifacts. We define
                    them upfront in writing so you know exactly what "done" looks like.
                  </p>
                </div>
              </FadeIn>

              <FadeIn delay={0.1}>
                <ul className="space-y-4">
                  {service.deliverables.map((item) => (
                    <li
                      key={item}
                      className="flex items-start gap-3 p-4 rounded-xl bg-gray-50 hover:bg-[#3EBA9E]/5 transition-colors"
                    >
                      <span
                        className={cn(
                          "mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-full bg-gradient-to-br shrink-0",
                          service.accent
                        )}
                      >
                        <Check className="h-3.5 w-3.5 text-white" />
                      </span>
                      <span className="text-gray-700">{item}</span>
                    </li>
                  ))}
                </ul>
              </FadeIn>
            </div>
          </div>
        </section>

        {/* Process */}
        <section
          id="process"
          className="relative w-full py-20 md:py-28 bg-gray-50 scroll-mt-32"
        >
          <MinimalistPattern className="absolute inset-0 opacity-5" />
          <div className="container relative px-4 md:px-6 z-10">
            <FadeIn>
              <div className="max-w-2xl mx-auto text-center mb-14 space-y-3">
                <p className="text-sm font-semibold tracking-widest text-[#3EBA9E] uppercase">
                  Our process
                </p>
                <h2 className="text-3xl md:text-4xl font-bold text-[#00664E] tracking-tight">
                  How we work, step by step
                </h2>
                <p className="text-gray-600 md:text-lg">
                  A simple, repeatable approach that keeps you informed at every stage — no
                  surprises, no scope creep.
                </p>
              </div>
            </FadeIn>

            <div className="relative max-w-5xl mx-auto">
              <div className="absolute left-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-[#00664E]/20 via-[#3EBA9E]/30 to-[#00664E]/20 hidden md:block" />
              <StaggerChildren className="space-y-8 md:space-y-12" staggerDelay={0.1}>
                {service.process.map((step, i) => {
                  const StepIcon = step.icon
                  const isEven = i % 2 === 0
                  return (
                    <div
                      key={step.title}
                      className={cn(
                        "md:grid md:grid-cols-2 md:gap-12 items-center",
                        isEven ? "" : "md:[&>*:first-child]:order-2"
                      )}
                    >
                      <div className={cn("md:text-right", isEven ? "" : "md:text-left")}>
                        <div
                          className={cn(
                            "inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#3EBA9E]/10 text-[#00664E] text-xs font-semibold tracking-wider uppercase mb-3",
                            isEven ? "md:ml-auto" : ""
                          )}
                        >
                          Step {i + 1}
                        </div>
                        <h3 className="text-2xl font-bold text-[#00664E] mb-2">{step.title}</h3>
                        <p className="text-gray-600 leading-relaxed">{step.description}</p>
                      </div>
                      <div className="hidden md:flex justify-center mt-4 md:mt-0">
                        <div
                          className={cn(
                            "relative h-20 w-20 rounded-2xl bg-gradient-to-br shadow-xl flex items-center justify-center",
                            service.accent
                          )}
                        >
                          <StepIcon className="h-10 w-10 text-white" />
                          <span className="absolute -top-2 -right-2 h-7 w-7 rounded-full bg-white text-[#00664E] text-sm font-bold flex items-center justify-center shadow-md border border-gray-100">
                            {i + 1}
                          </span>
                        </div>
                      </div>
                      <div className="md:hidden mt-4 flex items-center gap-3">
                        <div
                          className={cn(
                            "h-12 w-12 rounded-xl bg-gradient-to-br flex items-center justify-center shrink-0",
                            service.accent
                          )}
                        >
                          <StepIcon className="h-6 w-6 text-white" />
                        </div>
                      </div>
                    </div>
                  )
                })}
              </StaggerChildren>
            </div>
          </div>
        </section>

        {/* FAQ */}
        <section className="relative w-full py-20 md:py-28 bg-white">
          <div className="container px-4 md:px-6 z-10">
            <FadeIn>
              <div className="max-w-2xl mx-auto text-center mb-12 space-y-3">
                <p className="text-sm font-semibold tracking-widest text-[#3EBA9E] uppercase">
                  Frequently asked
                </p>
                <h2 className="text-3xl md:text-4xl font-bold text-[#00664E] tracking-tight">
                  {service.name} questions
                </h2>
                <p className="text-gray-600 md:text-lg">
                  The questions teams ask before signing on. If yours isn't here, get in touch.
                </p>
              </div>
            </FadeIn>
            <FadeIn delay={0.1} className="max-w-3xl mx-auto">
              <FaqSection items={faqItems} />
            </FadeIn>
          </div>
        </section>

        {/* Related services */}
        <section className="relative w-full py-16 md:py-20 bg-gray-50 border-t border-gray-100">
          <div className="container px-4 md:px-6">
            <FadeIn>
              <h2 className="text-2xl md:text-3xl font-bold text-[#00664E] mb-8 text-center">
                Explore other services
              </h2>
            </FadeIn>
            <StaggerChildren
              className="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-5xl mx-auto"
              staggerDelay={0.08}
            >
              {otherServices.map((other) => {
                const OtherIcon = other.icon
                return (
                  <Link
                    key={other.slug}
                    href={`/services/${other.slug}`}
                    className="group flex items-center gap-4 p-5 rounded-xl bg-white border border-gray-100 hover:border-[#3EBA9E]/40 hover:shadow-md transition-all"
                  >
                    <div
                      className={cn(
                        "h-11 w-11 rounded-xl bg-gradient-to-br flex items-center justify-center shrink-0",
                        other.accent
                      )}
                    >
                      <OtherIcon className="h-5 w-5 text-white" />
                    </div>
                    <div className="min-w-0 flex-1">
                      <p className="font-semibold text-[#00664E] truncate">{other.name}</p>
                      <p className="text-xs text-gray-500 truncate">{other.tagline}</p>
                    </div>
                    <ArrowRight className="h-4 w-4 text-gray-400 group-hover:text-[#00664E] group-hover:translate-x-1 transition-all shrink-0" />
                  </Link>
                )
              })}
            </StaggerChildren>
          </div>
        </section>

        {/* CTA */}
        <section className="relative w-full py-20 md:py-28 overflow-hidden">
          <div
            className={cn(
              "absolute inset-0 bg-gradient-to-br opacity-95",
              service.accent
            )}
          />
          <MinimalistPattern className="absolute inset-0 opacity-10" />
          <div className="container relative px-4 md:px-6 z-10">
            <div className="flex flex-col items-center text-center max-w-2xl mx-auto space-y-5">
              <FadeIn direction="up">
                <h2 className="text-3xl md:text-4xl font-bold tracking-tight text-white">
                  Ready to talk about your project?
                </h2>
              </FadeIn>
              <FadeIn delay={0.15}>
                <p className="text-white/90 md:text-lg">
                  A 30-minute call to scope the work, talk timelines, and decide if we're a fit —
                  free, no obligation.
                </p>
              </FadeIn>
              <FadeIn delay={0.3}>
                <Button
                  asChild
                  size="lg"
                  className="bg-white text-[#00664E] hover:bg-white/90 px-8 mt-2"
                >
                  <Link href="/contact">
                    Schedule a call
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

type InfoCardProps = Readonly<{
  icon: typeof Clock
  label: string
  value: string
}>

function InfoCard({ icon: Icon, label, value }: InfoCardProps) {
  return (
    <div className="flex items-start gap-3 p-5 rounded-xl bg-white border border-gray-100 hover:border-[#3EBA9E]/40 hover:shadow-md transition-all">
      <div className="h-10 w-10 rounded-lg bg-[#3EBA9E]/10 flex items-center justify-center shrink-0">
        <Icon className="h-5 w-5 text-[#00664E]" />
      </div>
      <div className="min-w-0 flex-1">
        <p className="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-1">
          {label}
        </p>
        <p className="font-semibold text-[#00664E] leading-snug">{value}</p>
      </div>
    </div>
  )
}
