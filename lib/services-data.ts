import type { LucideIcon } from "lucide-react"
import {
  Code2,
  Compass,
  HeadphonesIcon,
  Layers,
  Palette,
  Rocket,
  Search,
  Settings,
  ShieldCheck,
  Sparkles,
  TestTube,
  Wrench,
} from "lucide-react"

export type ServiceProcessStep = {
  title: string
  description: string
  icon: LucideIcon
}

export type Service = {
  slug: string
  name: string
  tagline: string
  shortDescription: string
  longDescription: string
  icon: LucideIcon
  accent: string
  startingPrice: string
  typicalTimeline: string
  bestFor: string
  deliverables: string[]
  process: ServiceProcessStep[]
  faqs: { question: string; answer: string }[]
}

export const services: Service[] = [
  {
    slug: "custom-development",
    name: "Custom Development",
    tagline: "Production-grade software, built to your spec",
    shortDescription:
      "Web, mobile, and API products engineered for scale — from MVP to growth stage.",
    longDescription:
      "We design and build software end-to-end for founders and teams that need to ship real products fast. Whether you're validating an idea or rebuilding a stack that's outgrown its limits, our engineers work as an extension of your team with clear scoping, transparent delivery, and code you'll be proud to own.",
    icon: Code2,
    accent: "from-[#00664E] to-[#3EBA9E]",
    startingPrice: "From $8,000",
    typicalTimeline: "6 — 14 weeks",
    bestFor: "Founders launching MVPs, scale-ups rebuilding legacy stacks, enterprises adding new product lines",
    deliverables: [
      "Production codebase in a repo you own from day one",
      "Cloud deployment with CI/CD pipeline",
      "Technical documentation and runbook",
      "Handover session with your engineering team",
      "30 days of post-launch support",
    ],
    process: [
      {
        title: "Discovery",
        description: "Two-week sprint to nail down scope, users, and success metrics.",
        icon: Search,
      },
      {
        title: "Design",
        description: "Wireframes, prototypes, and architecture decisions reviewed with you.",
        icon: Compass,
      },
      {
        title: "Build",
        description: "Weekly demos, async updates, and a working preview from day one.",
        icon: Layers,
      },
      {
        title: "Launch",
        description: "Production deployment, monitoring, and a smooth handover.",
        icon: Rocket,
      },
    ],
    faqs: [
      {
        question: "Do I own the code?",
        answer:
          "Yes — code lives in your repo from day one, on your cloud account. We hand over keys at the end of every engagement.",
      },
      {
        question: "What tech stack do you use?",
        answer:
          "We default to TypeScript across the board (Next.js, React Native, Node) with Postgres and AWS or Vercel. We're flexible — if your team prefers another stack, we'll adapt.",
      },
      {
        question: "Can you work with our existing team?",
        answer:
          "Absolutely. We embed cleanly with in-house engineers, follow your conventions, and join your stand-ups when useful.",
      },
    ],
  },
  {
    slug: "product-design",
    name: "Product Design",
    tagline: "Interfaces users actually understand",
    shortDescription:
      "User research, UX flows, and pixel-perfect interfaces that ship — not just decks.",
    longDescription:
      "We approach design as a problem-solving discipline, not a coat of paint. Every screen is justified by a user need, every interaction tested against real flows, and every artifact handed off in a state your engineers can build from immediately. The result: products people use without a manual.",
    icon: Palette,
    accent: "from-[#3EBA9E] to-[#00664E]",
    startingPrice: "From $4,500",
    typicalTimeline: "3 — 8 weeks",
    bestFor: "Teams with a product idea that needs validation, or an existing app that's confusing users",
    deliverables: [
      "User research report with interview summaries",
      "Information architecture and user flows",
      "High-fidelity Figma designs (light and dark)",
      "Interactive prototype for stakeholder demos",
      "Developer handover with design tokens and specs",
    ],
    process: [
      {
        title: "Research",
        description: "Interviews with 5–8 users, competitive teardown, and JTBD framing.",
        icon: Search,
      },
      {
        title: "Architect",
        description: "Flows, sitemap, and low-fi wireframes you can poke holes in.",
        icon: Compass,
      },
      {
        title: "Design",
        description: "High-fidelity screens, motion specs, and a clean Figma library.",
        icon: Sparkles,
      },
      {
        title: "Handover",
        description: "Engineer-ready specs and a walkthrough with your dev team.",
        icon: Layers,
      },
    ],
    faqs: [
      {
        question: "Do you do brand identity too?",
        answer:
          "We focus on product design — UX, UI, and prototyping. We can recommend trusted brand studios for logo and identity work and collaborate with them on your project.",
      },
      {
        question: "Will we get a design system?",
        answer:
          "Every engagement ships with a Figma library of components, colour tokens, and typography styles you can extend.",
      },
      {
        question: "Can you redesign an existing product?",
        answer:
          "Yes — most of our design work is redesign rather than greenfield. We start with a UX audit so changes are measurable.",
      },
    ],
  },
  {
    slug: "consulting",
    name: "Technical Consulting",
    tagline: "Senior eyes on your hardest decisions",
    shortDescription:
      "Architecture reviews, technology selection, and digital transformation roadmaps.",
    longDescription:
      "When the cost of getting it wrong is high, you don't need another hire — you need a senior partner who's shipped this before. We work as fractional CTOs and technical advisors for founders, leadership teams, and boards making decisions that shape the next two years.",
    icon: ShieldCheck,
    accent: "from-[#00664E] to-[#3EBA9E]",
    startingPrice: "From $2,000 / month",
    typicalTimeline: "Ongoing retainer or 2 — 6 week sprint",
    bestFor: "Non-technical founders, leadership teams scaling their stack, boards evaluating tech investments",
    deliverables: [
      "Architecture review document with prioritised recommendations",
      "Technology selection matrix with trade-off analysis",
      "Hiring plan with role specs and rubrics",
      "Quarterly roadmap reviews and async availability",
      "Direct access to senior engineering and product leadership",
    ],
    process: [
      {
        title: "Audit",
        description: "Deep-dive on your current state — code, team, processes, and risks.",
        icon: Search,
      },
      {
        title: "Recommend",
        description: "A written report with prioritised actions and the trade-offs behind each.",
        icon: Compass,
      },
      {
        title: "Implement",
        description: "Hands-on support as you execute — we don't just hand off and disappear.",
        icon: Settings,
      },
      {
        title: "Review",
        description: "Quarterly check-ins to course-correct as the business evolves.",
        icon: TestTube,
      },
    ],
    faqs: [
      {
        question: "Is this a fractional CTO arrangement?",
        answer:
          "It can be. Some clients want a true fractional CTO with weekly cadence; others want sprint-based reviews. We shape the engagement around what you actually need.",
      },
      {
        question: "Do you sign NDAs?",
        answer: "Always — we sign your NDA before any sensitive conversation.",
      },
      {
        question: "Can you help us hire engineers?",
        answer:
          "Yes. We help define role specs, run technical interviews, and design hiring rubrics. We can also tap our network for warm intros.",
      },
    ],
  },
  {
    slug: "maintenance",
    name: "Maintenance & Support",
    tagline: "Keep your product fast, secure, and shipping",
    shortDescription:
      "Ongoing engineering, monitoring, and iteration so your product stays sharp after launch.",
    longDescription:
      "Software doesn't end at launch — it begins. Our maintenance retainers cover everything from urgent bug fixes and security patches to performance work and steady feature iteration. You get a dedicated engineer on call and predictable monthly billing instead of fire-drill invoices.",
    icon: Wrench,
    accent: "from-[#3EBA9E] to-[#00664E]",
    startingPrice: "From $1,500 / month",
    typicalTimeline: "Rolling monthly retainer",
    bestFor: "Teams without in-house engineering, or in-house teams who need overflow capacity",
    deliverables: [
      "Dedicated engineer with response SLAs",
      "24/7 uptime monitoring and incident alerts",
      "Monthly security patches and dependency updates",
      "Performance optimisation and refactoring",
      "Monthly written report with metrics and changes",
    ],
    process: [
      {
        title: "Onboard",
        description: "We learn your codebase, deployment, and on-call expectations.",
        icon: Search,
      },
      {
        title: "Monitor",
        description: "Uptime, errors, and performance tracked with alerts wired to us.",
        icon: ShieldCheck,
      },
      {
        title: "Fix & Improve",
        description: "Bugs squashed within SLA, incremental improvements every sprint.",
        icon: Settings,
      },
      {
        title: "Report",
        description: "A monthly digest of what changed, what's next, and what we're watching.",
        icon: HeadphonesIcon,
      },
    ],
    faqs: [
      {
        question: "What's your response time?",
        answer:
          "Critical incidents are acknowledged within 1 hour during business hours and 4 hours overnight. Non-critical issues are triaged within 1 business day.",
      },
      {
        question: "Do you support products you didn't build?",
        answer:
          "Yes — about half our maintenance clients came to us with an existing codebase. We do a paid 1-week audit before committing.",
      },
      {
        question: "Can we scale up or down month to month?",
        answer:
          "Yes. Retainers are monthly with a 30-day notice for changes. Many clients ramp up around launches and scale back during steady-state.",
      },
    ],
  },
]

export function getServiceBySlug(slug: string): Service | undefined {
  return services.find((service) => service.slug === slug)
}

export function getAllServiceSlugs(): string[] {
  return services.map((service) => service.slug)
}
