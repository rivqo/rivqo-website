"use client"

import { useState } from "react"
import Link from "next/link"
import {
  ArrowRight,
  CreditCard,
  School,
  FileText,
  Zap,
  Check,
  ExternalLink,
} from "lucide-react"
import { motion, AnimatePresence } from "framer-motion"

import { Button } from "@/components/ui/button"
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs"
import { cn } from "@/lib/utils"

type Product = {
  id: string
  name: string
  tagline: string
  icon: React.ComponentType<{ className?: string }>
  problem: string
  solution: string
  benefits: { title: string; description: string }[]
  features: string[]
  cta: { label: string; href: string; external?: boolean }
  mockup: React.ReactNode
}

const products: Product[] = [
  {
    id: "veezocard",
    name: "VeezoCard",
    tagline: "Digital business cards that close more deals",
    icon: CreditCard,
    problem:
      "Paper business cards get lost. Most sellers can't share their catalogue without a website.",
    solution:
      "VeezoCard turns your phone into a shareable storefront — share a link, get a sale.",
    benefits: [
      {
        title: "Share in one tap",
        description: "Send your card via WhatsApp, SMS, or QR — no app install required.",
      },
      {
        title: "WhatsApp checkout",
        description: "Customers browse your catalogue and order directly through WhatsApp.",
      },
      {
        title: "Know what works",
        description: "See which products get views, clicks, and orders — in real time.",
      },
    ],
    features: [
      "Customisable card templates",
      "WhatsApp store with product catalogue",
      "Built-in analytics dashboard",
      "Seamless payment integration",
    ],
    cta: { label: "Visit VeezoCard", href: "https://veezocard.com", external: true },
    mockup: <VeezoMockup />,
  },
  {
    id: "noctua",
    name: "Noctua",
    tagline: "School operations, simplified",
    icon: School,
    problem:
      "School admins lose 12+ hours a week to manual fees, attendance, and report cards.",
    solution:
      "Noctua brings every school workflow — academic, financial, communication — into one dashboard.",
    benefits: [
      {
        title: "Cut admin time by 70%",
        description: "Automate fee reconciliation, attendance, and reporting in one place.",
      },
      {
        title: "Parents always in the loop",
        description: "Real-time updates on grades, fees, and announcements via SMS and app.",
      },
      {
        title: "Scales with your school",
        description: "From 50 to 5,000 students — performance stays the same.",
      },
    ],
    features: [
      "Student records & enrolment",
      "Automated fee management",
      "Attendance tracking",
      "Parent communication portal",
    ],
    cta: { label: "Explore Noctua", href: "https://noctua.rivqo.com", external: true },
    mockup: <NoctuaMockup />,
  },
  {
    id: "swiifta",
    name: "Swiifta",
    tagline: "Bill payments API for African businesses",
    icon: Zap,
    problem:
      "Adding bill payments to your product means months of integrations with each provider.",
    solution:
      "One Swiifta API integration unlocks airtime, data, electricity, cable TV, and more.",
    benefits: [
      {
        title: "One integration, every biller",
        description: "Ship payment features in days, not months.",
      },
      {
        title: "Built for scale",
        description: "99.9% uptime with automatic failover across providers.",
      },
      {
        title: "Transparent pricing",
        description: "Pay per transaction. No setup fees, no hidden costs.",
      },
    ],
    features: [
      "Utility bill payments",
      "Airtime & data top-ups",
      "Secure PCI-compliant processing",
      "Real-time transaction reporting",
    ],
    cta: { label: "Read the docs", href: "/products/swiifta" },
    mockup: <SwiiftaMockup />,
  },
  {
    id: "peakcv",
    name: "peakCV",
    tagline: "Professional resumes in minutes",
    icon: FileText,
    problem:
      "Most CV builders are bloated, expensive, or produce templates that recruiters skim past.",
    solution:
      "peakCV gives you ATS-friendly templates and a focused editor that gets you to 'done' fast.",
    benefits: [
      {
        title: "Built for African talent",
        description: "Templates and prompts tuned to local job markets and recruiter expectations.",
      },
      {
        title: "ATS-friendly by default",
        description: "Every template passes applicant tracking systems on the first try.",
      },
      {
        title: "Free to start",
        description: "Build and export your first CV without entering a card.",
      },
    ],
    features: [
      "Curated professional templates",
      "Guided section prompts",
      "One-click PDF export",
      "Multiple CV versions per account",
    ],
    cta: { label: "Try peakCV", href: "https://peakcv.rivqo.com", external: true },
    mockup: <PeakCVMockup />,
  },
]

export default function ProductShowcase() {
  const [activeTab, setActiveTab] = useState(products[0].id)

  return (
    <div className="mt-12">
      <Tabs value={activeTab} onValueChange={setActiveTab} className="w-full">
        <TabsList className="grid grid-cols-2 md:grid-cols-4 w-full max-w-3xl mx-auto h-auto bg-[#00664E]/5 p-1.5 rounded-2xl">
          {products.map((product) => {
            const Icon = product.icon
            const isActive = activeTab === product.id
            return (
              <TabsTrigger
                key={product.id}
                value={product.id}
                className={cn(
                  "flex flex-col md:flex-row items-center gap-2 py-3 px-4 rounded-xl text-sm font-medium transition-all",
                  "data-[state=active]:bg-white data-[state=active]:text-[#00664E] data-[state=active]:shadow-md",
                  "text-gray-600 hover:text-[#00664E]"
                )}
              >
                <Icon
                  className={cn(
                    "h-4 w-4 transition-colors",
                    isActive ? "text-[#3EBA9E]" : "text-gray-400"
                  )}
                />
                <span>{product.name}</span>
              </TabsTrigger>
            )
          })}
        </TabsList>

        {products.map((product) => (
          <TabsContent key={product.id} value={product.id} className="mt-10 focus-visible:outline-none">
            <AnimatePresence mode="wait">
              <motion.div
                key={product.id}
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                exit={{ opacity: 0, y: -20 }}
                transition={{ duration: 0.4, ease: "easeOut" }}
                className="grid lg:grid-cols-2 gap-12 items-center"
              >
                {/* Left: content */}
                <div className="space-y-6">
                  <div className="space-y-3">
                    <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#3EBA9E]/10 text-[#00664E] text-xs font-semibold tracking-wider uppercase">
                      <product.icon className="h-3.5 w-3.5" />
                      {product.name}
                    </div>
                    <h3 className="text-3xl md:text-4xl font-bold text-[#00664E] tracking-tight">
                      {product.tagline}
                    </h3>
                  </div>

                  <div className="space-y-4">
                    <div className="pl-4 border-l-2 border-red-200">
                      <p className="text-xs font-semibold uppercase tracking-wider text-red-600 mb-1">
                        The problem
                      </p>
                      <p className="text-gray-700">{product.problem}</p>
                    </div>
                    <div className="pl-4 border-l-2 border-[#3EBA9E]">
                      <p className="text-xs font-semibold uppercase tracking-wider text-[#00664E] mb-1">
                        How {product.name} solves it
                      </p>
                      <p className="text-gray-700">{product.solution}</p>
                    </div>
                  </div>

                  <div className="grid sm:grid-cols-3 gap-3 pt-2">
                    {product.benefits.map((benefit, i) => (
                      <motion.div
                        key={benefit.title}
                        initial={{ opacity: 0, y: 10 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ delay: 0.2 + i * 0.1, duration: 0.4 }}
                        className="p-4 rounded-xl bg-white border border-gray-100 hover:border-[#3EBA9E]/40 hover:shadow-md transition-all"
                      >
                        <p className="text-sm font-semibold text-[#00664E] mb-1">
                          {benefit.title}
                        </p>
                        <p className="text-xs text-gray-600 leading-relaxed">
                          {benefit.description}
                        </p>
                      </motion.div>
                    ))}
                  </div>

                  <ul className="grid sm:grid-cols-2 gap-2 pt-2">
                    {product.features.map((feature) => (
                      <li key={feature} className="flex items-start gap-2 text-sm text-gray-700">
                        <Check className="h-4 w-4 text-[#3EBA9E] mt-0.5 shrink-0" />
                        <span>{feature}</span>
                      </li>
                    ))}
                  </ul>

                  <div className="pt-2">
                    <Button asChild className="bg-[#00664E] hover:bg-[#00664E]/90 group">
                      <Link
                        href={product.cta.href}
                        target={product.cta.external ? "_blank" : undefined}
                        rel={product.cta.external ? "noopener noreferrer" : undefined}
                      >
                        {product.cta.label}
                        {product.cta.external ? (
                          <ExternalLink className="ml-2 h-4 w-4 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" />
                        ) : (
                          <ArrowRight className="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform" />
                        )}
                      </Link>
                    </Button>
                  </div>
                </div>

                {/* Right: mockup */}
                <div className="relative">
                  <div className="absolute -inset-4 bg-gradient-to-br from-[#3EBA9E]/20 to-[#00664E]/10 rounded-3xl blur-2xl" />
                  <div className="relative rounded-2xl bg-gradient-to-br from-white to-gray-50 border border-gray-100 shadow-xl p-6 md:p-8 overflow-hidden">
                    {product.mockup}
                  </div>
                </div>
              </motion.div>
            </AnimatePresence>
          </TabsContent>
        ))}
      </Tabs>
    </div>
  )
}

function VeezoMockup() {
  return (
    <div className="aspect-[4/3] flex items-center justify-center">
      <div className="relative w-full max-w-xs">
        <div className="absolute inset-0 bg-[#00664E] rounded-2xl rotate-6 opacity-20" />
        <div className="relative rounded-2xl bg-gradient-to-br from-[#00664E] to-[#3EBA9E] p-6 text-white shadow-2xl">
          <div className="flex items-center gap-3 mb-6">
            <div className="h-12 w-12 rounded-full bg-white/20 flex items-center justify-center font-bold text-lg">
              A
            </div>
            <div>
              <p className="font-semibold">Ada Okafor</p>
              <p className="text-xs text-white/80">Founder, Bloom Lagos</p>
            </div>
          </div>
          <div className="space-y-2 text-xs">
            <div className="flex items-center gap-2 bg-white/10 rounded-lg p-2">
              <CreditCard className="h-3.5 w-3.5" />
              <span>+234 901 234 5678</span>
            </div>
            <div className="bg-white/10 rounded-lg p-2">bloomlagos@veezo.cards</div>
          </div>
          <div className="mt-4 grid grid-cols-3 gap-2">
            {[1, 2, 3].map((i) => (
              <div key={i} className="aspect-square rounded-lg bg-white/10" />
            ))}
          </div>
          <div className="mt-4 w-full rounded-lg bg-white text-[#00664E] text-xs text-center py-2 font-semibold">
            Order on WhatsApp
          </div>
        </div>
      </div>
    </div>
  )
}

function NoctuaMockup() {
  return (
    <div className="aspect-[4/3] flex items-center justify-center">
      <div className="w-full space-y-3">
        <div className="flex items-center justify-between pb-2 border-b border-gray-100">
          <p className="text-sm font-semibold text-[#00664E]">Dashboard</p>
          <span className="text-xs text-gray-400">Term 2 · 2026</span>
        </div>
        <div className="grid grid-cols-3 gap-2">
          {[
            { label: "Students", value: "847" },
            { label: "Attendance", value: "94%" },
            { label: "Fees paid", value: "₦8.4M" },
          ].map((stat) => (
            <div key={stat.label} className="rounded-lg bg-[#3EBA9E]/5 p-2.5">
              <p className="text-xs text-gray-500">{stat.label}</p>
              <p className="text-base font-bold text-[#00664E]">{stat.value}</p>
            </div>
          ))}
        </div>
        <div className="space-y-1.5">
          {[
            { name: "JSS 1 — Mathematics", progress: 78 },
            { name: "JSS 2 — English", progress: 92 },
            { name: "SS 1 — Physics", progress: 64 },
          ].map((cls) => (
            <div key={cls.name} className="rounded-lg border border-gray-100 p-2.5">
              <div className="flex justify-between text-xs mb-1.5">
                <span className="text-gray-700">{cls.name}</span>
                <span className="font-semibold text-[#00664E]">{cls.progress}%</span>
              </div>
              <div className="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                <div
                  className="h-full bg-gradient-to-r from-[#00664E] to-[#3EBA9E] rounded-full"
                  style={{ width: `${cls.progress}%` }}
                />
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  )
}

function SwiiftaMockup() {
  return (
    <div className="aspect-[4/3] flex items-center justify-center font-mono">
      <div className="w-full rounded-xl bg-[#0d1117] text-green-300 text-xs p-4 shadow-2xl overflow-hidden">
        <div className="flex gap-1.5 pb-3 border-b border-white/10 mb-3">
          <div className="h-2.5 w-2.5 rounded-full bg-red-500/80" />
          <div className="h-2.5 w-2.5 rounded-full bg-yellow-500/80" />
          <div className="h-2.5 w-2.5 rounded-full bg-green-500/80" />
        </div>
        <pre className="leading-relaxed whitespace-pre-wrap">
{`POST /v1/bills/pay
Authorization: Bearer sk_live_...

{
  "biller": "ikedc_prepaid",
  "meter": "04123456789",
  "amount": 5000,
  "currency": "NGN"
}

`}
          <span className="text-white/60">{`// Response`}</span>
{`
{
  "status": "success",
  "token": "1234-5678-9012-3456",
  "ref": "swft_8x2k9m"
}`}
        </pre>
      </div>
    </div>
  )
}

function PeakCVMockup() {
  return (
    <div className="aspect-[4/3] flex items-center justify-center">
      <div className="w-full max-w-xs bg-white rounded-lg shadow-xl border border-gray-200 p-5 text-xs">
        <div className="text-center pb-3 border-b border-gray-200">
          <p className="text-lg font-bold text-[#00664E]">Tunde Adebayo</p>
          <p className="text-gray-500 text-[10px] mt-0.5">
            Senior Software Engineer · Lagos, NG
          </p>
        </div>
        <div className="mt-3 space-y-3">
          <div>
            <p className="font-semibold text-[#00664E] text-[10px] uppercase tracking-wider mb-1.5">
              Experience
            </p>
            <div className="space-y-1.5">
              <div>
                <p className="font-medium text-gray-800 text-[11px]">Lead Engineer · Paystack</p>
                <p className="text-[10px] text-gray-500">2022 — Present</p>
              </div>
              <div>
                <p className="font-medium text-gray-800 text-[11px]">Engineer · Andela</p>
                <p className="text-[10px] text-gray-500">2019 — 2022</p>
              </div>
            </div>
          </div>
          <div>
            <p className="font-semibold text-[#00664E] text-[10px] uppercase tracking-wider mb-1.5">
              Skills
            </p>
            <div className="flex flex-wrap gap-1">
              {["TypeScript", "Go", "AWS", "PostgreSQL"].map((s) => (
                <span
                  key={s}
                  className="px-1.5 py-0.5 rounded bg-[#3EBA9E]/10 text-[#00664E] text-[9px]"
                >
                  {s}
                </span>
              ))}
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
