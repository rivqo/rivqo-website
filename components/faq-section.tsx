"use client"

import {
  Accordion,
  AccordionContent,
  AccordionItem,
  AccordionTrigger,
} from "@/components/ui/accordion"

type FaqItem = {
  id: string
  question: string
  answer: string
}

interface FaqSectionProps {
  readonly items?: readonly FaqItem[]
}

const defaultItems: readonly FaqItem[] = [
  {
    id: "projects",
    question: "What kinds of projects do you work on?",
    answer:
      "We build production-grade web and mobile applications — from MVPs for early-stage founders to full platform rebuilds for established businesses. Our sweet spot is fintech, edtech, and B2B SaaS serving African markets.",
  },
  {
    id: "timeline",
    question: "How long does a typical engagement take?",
    answer:
      "A focused MVP usually takes 6–10 weeks. Larger platforms range from 3–6 months. We always begin with a 1–2 week discovery sprint so you get a concrete timeline and cost before committing to the full build.",
  },
  {
    id: "support",
    question: "Do you offer support after launch?",
    answer:
      "Yes. Every project ships with a 30-day post-launch support window. After that, we offer monthly retainers for maintenance, monitoring, performance work, and feature iteration.",
  },
  {
    id: "swiifta-integration",
    question: "Can I integrate Swiifta into my existing product?",
    answer:
      "Absolutely — Swiifta is a REST API with SDKs for Node, Python, and PHP. Most teams get to their first live transaction within a day. We also offer a sandbox environment for testing.",
  },
  {
    id: "pricing",
    question: "What does pricing look like?",
    answer:
      "Custom builds are scoped per project after discovery. Our products have transparent pricing: VeezoCard and peakCV offer free tiers, Swiifta is per-transaction, and Noctua is priced per school based on enrolment.",
  },
  {
    id: "location",
    question: "Where is your team based?",
    answer:
      "Our headquarters is in Lagos, Nigeria, with team members distributed across West Africa. We work async-first and stay reachable on EST, GMT, and WAT hours.",
  },
]

export default function FaqSection({ items = defaultItems }: FaqSectionProps) {
  return (
    <Accordion type="single" collapsible className="w-full divide-y divide-gray-100">
      {items.map((item) => (
        <AccordionItem
          key={item.id}
          value={item.id}
          className="border-0 group rounded-xl px-4 transition-colors hover:bg-[#3EBA9E]/5"
        >
          <AccordionTrigger className="text-left text-base md:text-lg font-medium text-[#00664E] hover:no-underline py-5">
            {item.question}
          </AccordionTrigger>
          <AccordionContent className="text-gray-600 leading-relaxed pb-5 pr-4">
            {item.answer}
          </AccordionContent>
        </AccordionItem>
      ))}
    </Accordion>
  )
}
