import Link from "next/link"
import { ArrowRight, Check, CreditCard, FileText, School, Zap, ExternalLink } from "lucide-react"

import { Button } from "@/components/ui/button"
import ProductCard from "@/components/product-card"
import MinimalistPattern from "@/components/minimalist-pattern"
import FadeIn from "@/components/animations/fade-in"
import StaggerChildren from "@/components/animations/stagger-children"
import { ParallaxElement } from "@/components/parallax-elements"
import { CircleShape, HexagonShape } from "@/components/parallax-shapes"

type Product = {
  id: string
  name: string
  icon: React.ComponentType<{ className?: string }>
  description: string
  features: string[]
  href: string
  external?: boolean
  reverse?: boolean
}

const products: Product[] = [
  {
    id: "veezocard",
    name: "VeezoCard",
    icon: CreditCard,
    description:
      "Create digital business cards and build WhatsApp stores with ease. Connect with customers and showcase your products in a modern, digital format that's never lost or thrown away.",
    features: [
      "Digital business cards with customizable templates",
      "WhatsApp store builder with product catalogue",
      "Built-in analytics and customer insights",
      "Seamless payment integration",
    ],
    href: "https://veezocard.com",
    external: true,
  },
  {
    id: "noctua",
    name: "Noctua",
    icon: School,
    description:
      "A complete school management system that brings academics, attendance, fees, and communication into one dashboard. Built for African schools, scaled for thousands of students.",
    features: [
      "Student records and enrolment management",
      "Automated fee collection and reconciliation",
      "Real-time attendance and grade tracking",
      "Parent communication portal with SMS",
    ],
    href: "https://noctua.rivqo.com",
    external: true,
    reverse: true,
  },
  {
    id: "swiifta",
    name: "Swiifta",
    icon: Zap,
    description:
      "A comprehensive bill payments API that lets your product offer airtime, data, utilities, and cable TV through a single integration. Built for scale, priced for transparency.",
    features: [
      "One API for every major biller",
      "99.9% uptime with provider failover",
      "PCI-compliant transaction processing",
      "Real-time reporting and reconciliation",
    ],
    href: "/products/swiifta",
  },
  {
    id: "peakcv",
    name: "peakCV",
    icon: FileText,
    description:
      "Create simple, ATS-friendly resumes that get past automated screeners and into recruiters' hands. Curated templates and guided prompts mean your CV is done in minutes, not hours.",
    features: [
      "ATS-friendly templates by default",
      "Guided prompts for every section",
      "One-click PDF export",
      "Multiple CV versions per account",
    ],
    href: "https://peakcv.rivqo.com",
    external: true,
    reverse: true,
  },
]

export default function ProductsPage() {
  return (
    <div className="flex flex-col min-h-screen">
      <main className="flex-1">
        {/* Hero Section */}
        <section className="relative w-full py-20 md:py-32 overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-br from-[#00664E] to-[#3EBA9E] opacity-90" />
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

          <div className="container relative px-4 md:px-6 z-10">
            <div className="flex flex-col items-center justify-center text-center max-w-3xl mx-auto space-y-4 mt-10 md:mt-0">
              <FadeIn direction="down">
                <p className="text-sm font-semibold tracking-widest text-white/80 uppercase">
                  Our products
                </p>
              </FadeIn>
              <FadeIn delay={0.1}>
                <h1 className="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl lg:text-6xl text-white">
                  Software you can ship with
                </h1>
              </FadeIn>
              <FadeIn delay={0.2}>
                <p className="max-w-[700px] text-white/90 md:text-xl pt-2">
                  Four production-grade products solving real problems for African businesses
                  and the people they serve.
                </p>
              </FadeIn>
            </div>
          </div>
        </section>

        {/* Product Grid */}
        <section className="w-full py-16 md:py-20 bg-gray-50 border-b border-gray-100">
          <div className="container px-4 md:px-6">
            <FadeIn>
              <StaggerChildren
                className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6"
                staggerDelay={0.08}
              >
                <ProductCard
                  title="VeezoCard"
                  description="Digital business card and WhatsApp store builder"
                  icon="credit-card"
                />
                <ProductCard
                  title="Noctua"
                  description="Complete school management system"
                  icon="school"
                />
                <ProductCard
                  title="Swiifta"
                  description="Comprehensive bill payments API"
                  icon="credit-card"
                />
                <ProductCard
                  title="peakCV"
                  description="Create simple, professional resumes with ease"
                  icon="file-text"
                />
              </StaggerChildren>
            </FadeIn>
          </div>
        </section>

        {/* Product Details */}
        <section className="w-full py-20 md:py-28">
          <div className="container px-4 md:px-6">
            <div className="grid gap-20 md:gap-28">
              {products.map((product) => {
                const Icon = product.icon
                return (
                  <FadeIn key={product.id} threshold={0.15}>
                    <div
                      id={product.id}
                      className="grid gap-8 lg:grid-cols-2 lg:gap-16 items-center scroll-mt-32"
                    >
                      <div
                        className={`flex flex-col justify-center space-y-5 ${
                          product.reverse ? "lg:order-2" : ""
                        }`}
                      >
                        <div className="inline-flex w-fit items-center gap-2 px-3 py-1.5 rounded-full bg-[#3EBA9E]/10 text-[#00664E] text-xs font-semibold tracking-wider uppercase">
                          <Icon className="h-3.5 w-3.5" />
                          {product.name}
                        </div>
                        <h2 className="text-3xl md:text-4xl font-bold tracking-tighter text-[#00664E]">
                          {product.name}
                        </h2>
                        <p className="max-w-[600px] text-gray-600 md:text-lg leading-relaxed">
                          {product.description}
                        </p>
                        <ul className="grid gap-3 pt-2">
                          {product.features.map((feature) => (
                            <li key={feature} className="flex items-start gap-3">
                              <span className="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-full bg-[#3EBA9E]/15 shrink-0">
                                <Check className="h-3 w-3 text-[#00664E]" />
                              </span>
                              <span className="text-gray-700">{feature}</span>
                            </li>
                          ))}
                        </ul>
                        <div className="pt-2">
                          <Button asChild className="px-8 bg-[#00664E] hover:bg-[#00664E]/90 group">
                            <Link
                              href={product.href}
                              target={product.external ? "_blank" : undefined}
                              rel={product.external ? "noopener noreferrer" : undefined}
                            >
                              {product.external ? "Visit site" : "Learn more"}
                              {product.external ? (
                                <ExternalLink className="ml-2 h-4 w-4 transition-transform group-hover:-translate-y-0.5 group-hover:translate-x-0.5" />
                              ) : (
                                <ArrowRight className="ml-2 h-4 w-4 transition-transform group-hover:translate-x-1" />
                              )}
                            </Link>
                          </Button>
                        </div>
                      </div>
                      <div
                        className={`flex items-center justify-center ${
                          product.reverse ? "lg:order-1" : ""
                        }`}
                      >
                        <ProductPreview product={product} />
                      </div>
                    </div>
                  </FadeIn>
                )
              })}
            </div>
          </div>
        </section>

        {/* CTA Section */}
        <section className="relative w-full py-20 md:py-28 overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-br from-[#00664E] to-[#3EBA9E] opacity-95" />
          <MinimalistPattern className="absolute inset-0 opacity-10" />
          <div className="container relative px-4 md:px-6 z-10">
            <div className="flex flex-col items-center justify-center space-y-5 text-center">
              <FadeIn direction="up">
                <h2 className="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-white">
                  Ready to get started?
                </h2>
              </FadeIn>
              <FadeIn delay={0.15}>
                <p className="max-w-[700px] text-white/90 md:text-xl">
                  Try a product, book a demo, or talk to us about a custom build — whichever fits
                  your stage.
                </p>
              </FadeIn>
              <FadeIn delay={0.3}>
                <div className="flex flex-col gap-3 sm:flex-row pt-2">
                  <Button asChild size="lg" className="px-8 bg-white text-[#00664E] hover:bg-white/90">
                    <Link href="/contact">Book a demo</Link>
                  </Button>
                  <Button
                    asChild
                    size="lg"
                    variant="outline"
                    className="px-8 border-white text-white bg-[#3EBA9E]/30 hover:bg-[#3EBA9E]/40"
                  >
                    <Link href="/contact">Contact sales</Link>
                  </Button>
                </div>
              </FadeIn>
            </div>
          </div>
        </section>
      </main>
    </div>
  )
}

type ProductPreviewProps = Readonly<{ product: Product }>

function ProductPreview({ product }: ProductPreviewProps) {
  const Icon = product.icon
  return (
    <div className="relative w-full max-w-md">
      <div className="absolute -inset-6 bg-gradient-to-br from-[#3EBA9E]/20 to-[#00664E]/10 rounded-3xl blur-2xl" />
      <div className="relative rounded-2xl bg-gradient-to-br from-white to-gray-50 border border-gray-100 shadow-xl p-8 aspect-[4/3] flex flex-col items-center justify-center text-center">
        <div className="h-20 w-20 rounded-2xl bg-gradient-to-br from-[#00664E] to-[#3EBA9E] flex items-center justify-center mb-5 shadow-lg">
          <Icon className="h-10 w-10 text-white" />
        </div>
        <p className="text-xl font-bold text-[#00664E]">{product.name}</p>
        <p className="text-sm text-gray-500 mt-2 max-w-[260px]">
          A glimpse of what {product.name} delivers — request a live demo to see more.
        </p>
      </div>
    </div>
  )
}
