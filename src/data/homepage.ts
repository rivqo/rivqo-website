import {
  Cable,
  CircleDollarSign,
  ClipboardList,
  FileStack,
  GitCompareArrows,
  TableProperties,
} from "lucide-react";
import type {
  CapabilityItem,
  CaseStudy,
  ConnectedItem,
  CredibilityPillar,
  EnquiryFieldOption,
  FlowNode,
  IndustryItem,
  MethodStage,
  ProblemItem,
  RoleOutcome,
} from "@/types/homepage";

export const hero = {
  eyebrow: "For engineering, energy and industrial-service companies",
  heading: "Run complex projects without chasing people for answers.",
  support:
    "Rivqo helps growing engineering, energy and industrial-service companies connect procurement, project costs, approvals and reporting into one reliable operating view.",
  secondaryCta: {
    label: "See how Rivqo works",
    href: "#method",
  },
  trust:
    "Built from firsthand experience in engineering, procurement and business systems.",
};

export const flowNodes: FlowNode[] = [
  {
    id: "request",
    code: "PR-184",
    label: "Purchase request",
    status: "Awaiting approval",
    tone: "neutral",
  },
  {
    id: "approval",
    code: "AP-184",
    label: "Approval",
    status: "Awaiting approval",
    tone: "warning",
  },
  {
    id: "vendor",
    code: "VN-62",
    label: "Vendor",
    status: "Vendor selected",
    tone: "ok",
  },
  {
    id: "delivery",
    code: "DL-441",
    label: "Delivery",
    status: "Delivery delayed",
    tone: "critical",
  },
  {
    id: "cost",
    code: "CS-184",
    label: "Project cost",
    status: "Cost updated",
    tone: "ok",
  },
  {
    id: "management",
    code: "MV-12",
    label: "Management view",
    status: "Document missing",
    tone: "critical",
  },
];

export const problems = {
  eyebrow: "The operating reality",
  heading: "Your projects are moving. Your information is not.",
  support:
    "Project information is often split across spreadsheets, WhatsApp, email, accounting tools, paper documents and individual employees. The work continues. The record does not.",
  closer:
    "The problem is rarely another missing dashboard. It is the process, ownership, data and systems behind it.",
  items: [
    {
      title: "Approvals buried in messages",
      detail:
        "Decisions sit in inboxes and group chats instead of a named path.",
    },
    {
      title: "Procurement status spread across files",
      detail:
        "Requests, quotations and orders live in different places, so nobody shares one picture.",
    },
    {
      title: "Project costs discovered too late",
      detail:
        "Commitments surface at month-end, after the work has already moved.",
    },
    {
      title: "Missing delivery and invoice evidence",
      detail:
        "Goods arrive, invoices follow, and the supporting documents do not.",
    },
    {
      title: "Reports rebuilt manually",
      detail:
        "Every leadership update is assembled again from half-current files.",
    },
    {
      title: "Management dependent on follow-ups",
      detail:
        "Visibility depends on who answers the phone, not on the workflow.",
    },
  ] satisfies ProblemItem[],
};

export const roles: RoleOutcome[] = [
  {
    id: "executive",
    label: "Executive",
    question: "Where is money being delayed or committed without control?",
    problem:
      "Exceptions reach leadership after they have already become financial surprises.",
    outcome:
      "See project delays, procurement exceptions, cost commitments and missing approvals before they become financial surprises.",
    interfaceTitle: "Leadership exceptions",
    interfaceRows: [
      {
        label: "Package B delivery",
        status: "Delivery delayed",
        tone: "critical",
      },
      {
        label: "PR-184 transformer",
        status: "Awaiting approval",
        tone: "warning",
      },
      {
        label: "Invoice 441 evidence",
        status: "Document missing",
        tone: "critical",
      },
    ],
  },
  {
    id: "operations",
    label: "Operations",
    question: "What is blocked, and who owns the next action?",
    problem: "Project status lives with people, not with the workflow.",
    outcome:
      "Know what is blocked, who owns the next action and which project needs attention.",
    interfaceTitle: "Blocked actions",
    interfaceRows: [
      {
        label: "Site access permit",
        status: "Owner: project lead",
        tone: "warning",
      },
      {
        label: "Cable drum delivery",
        status: "Delivery delayed",
        tone: "critical",
      },
      {
        label: "Variation VR-09",
        status: "Awaiting approval",
        tone: "neutral",
      },
    ],
  },
  {
    id: "procurement",
    label: "Procurement",
    question: "Where is this request in the buying cycle?",
    problem: "The request-to-invoice trail is split across files and chats.",
    outcome:
      "Trace requests, quotations, approvals, orders, deliveries, invoices and vendor performance.",
    interfaceTitle: "Buying trail",
    interfaceRows: [
      { label: "PR-184", status: "Awaiting approval", tone: "warning" },
      { label: "Vendor VN-62", status: "Vendor selected", tone: "ok" },
      { label: "PO vs delivery", status: "Delivery delayed", tone: "critical" },
    ],
  },
  {
    id: "finance",
    label: "Finance and Audit",
    question: "Can this cost be tied to evidence and a project code?",
    problem:
      "Operational activity arrives without documents or codes attached.",
    outcome:
      "Connect operational activity to supporting documents, project codes, reconciliation and financial records.",
    interfaceTitle: "Reconciliation queue",
    interfaceRows: [
      { label: "Invoice 441", status: "Document missing", tone: "critical" },
      { label: "PO-220 / GRN", status: "Cost updated", tone: "ok" },
      { label: "Project code E-14", status: "Unmatched line", tone: "warning" },
    ],
  },
  {
    id: "systems",
    label: "IT and Systems",
    question: "How do we connect this without adding another orphan system?",
    problem:
      "New tools arrive without owners, support or a place in the stack.",
    outcome:
      "Integrate selected workflows without creating another unsupported system or immediately replacing the existing stack.",
    interfaceTitle: "Sources in use",
    interfaceRows: [
      { label: "Accounting system", status: "Keep", tone: "ok" },
      { label: "Shared folders", status: "Connect evidence", tone: "warning" },
      { label: "Spreadsheets", status: "Replace over time", tone: "neutral" },
    ],
  },
];

export const capabilities = {
  eyebrow: "What Rivqo improves",
  heading: "The workflows that decide whether a project stays on track.",
  items: [
    {
      id: "procurement",
      title: "Procurement and vendor control",
      outcome: "Know who can buy, from whom, and where each request stands.",
      examples: [
        "Request-to-order trail",
        "Named vendor selection",
        "Delivery against the order",
      ],
      icon: ClipboardList,
    },
    {
      id: "cost",
      title: "Project cost and progress visibility",
      outcome:
        "See commitments and remaining work before the month-end surprise.",
      examples: [
        "Committed versus actual",
        "Package-level cost",
        "Variation tracking",
      ],
      icon: CircleDollarSign,
    },
    {
      id: "exceptions",
      title: "Reconciliation and exception management",
      outcome: "Surface mismatches while there is still time to resolve them.",
      examples: [
        "Order, delivery and invoice",
        "Missing evidence",
        "Aged exceptions",
      ],
      icon: GitCompareArrows,
    },
    {
      id: "approvals",
      title: "Approvals and document traceability",
      outcome: "Replace inbox archaeology with a named approval path.",
      examples: ["Approval matrix", "Document set per stage", "Audit trail"],
      icon: FileStack,
    },
    {
      id: "reporting",
      title: "Management reporting",
      outcome: "Give leadership a current picture without rebuilding slides.",
      examples: ["Exception summary", "Project status", "Delayed packages"],
      icon: TableProperties,
    },
    {
      id: "integration",
      title: "Systems integration and automation",
      outcome:
        "Connect the tools already in use, then automate only where it holds.",
      examples: [
        "Accounting link",
        "Evidence from shared folders",
        "Controlled notifications",
      ],
      icon: Cable,
    },
  ] satisfies CapabilityItem[],
};

export const connectedView = {
  eyebrow: "Before and after",
  heading: "Keep the tools that work. Connect the workflow that does not.",
  support:
    "Rivqo begins with the workflow causing the most cost, delay or uncertainty. We connect the necessary people, controls, information and systems without forcing an immediate company-wide replacement.",
  before: [
    { id: "spreadsheet", label: "Spreadsheet" },
    { id: "whatsapp", label: "WhatsApp" },
    { id: "accounting", label: "Accounting system" },
    { id: "email", label: "Email" },
    { id: "folders", label: "Shared folders" },
    { id: "knowledge", label: "Individual knowledge" },
  ] satisfies ConnectedItem[],
  after: [
    { id: "workflow", label: "Controlled workflow" },
    { id: "ownership", label: "Named ownership" },
    { id: "approval", label: "Approval trail" },
    { id: "evidence", label: "Connected evidence" },
    { id: "exceptions", label: "Exception visibility" },
    { id: "reporting", label: "Reliable reporting" },
  ] satisfies ConnectedItem[],
};

export const method = {
  eyebrow: "How we work",
  heading: "Start with evidence. Prove value before expanding.",
  closer:
    "Every stage should be useful on its own. Rivqo does not begin with an open-ended transformation programme.",
  stages: [
    {
      id: "diagnose",
      number: "01",
      title: "Diagnose",
      body: "Map the workflow, identify control failures and establish a credible baseline.",
    },
    {
      id: "prove",
      number: "02",
      title: "Prove",
      body: "Implement one bounded pilot with agreed users, responsibilities and success measures.",
    },
    {
      id: "deploy",
      number: "03",
      title: "Deploy",
      body: "Extend the validated workflow across the relevant projects, teams and integrations.",
    },
    {
      id: "improve",
      number: "04",
      title: "Improve",
      body: "Monitor performance, refine the system and introduce intelligent automation where it is justified.",
    },
  ] satisfies MethodStage[],
};

export const industries = {
  eyebrow: "Who we serve",
  heading: "Engineering, energy and industrial-service companies.",
  items: [
    {
      id: "epc",
      title: "Electrical and power EPC",
      realities: [
        "Multi-contractor packages and long-lead equipment make approval and cost status hard to hold in one place.",
        "Site variations move faster than the files that are supposed to record them.",
      ],
    },
    {
      id: "renewables",
      title: "Renewable-energy delivery",
      realities: [
        "Tight commissioning windows mean a delayed document quickly becomes a delayed energisation.",
      ],
    },
    {
      id: "oilandgas",
      title: "Oil-and-gas services and procurement",
      realities: [
        "High-value materials and third-party services need a traceable path from request to delivery evidence.",
      ],
    },
    {
      id: "maintenance",
      title: "Industrial maintenance",
      realities: [
        "Shutdowns and emergency work compress approvals, so parts and cost status have to stay visible under time pressure.",
      ],
    },
    {
      id: "consultancy",
      title: "Engineering and technical consultancy",
      realities: [
        "Time, subcontracted specialists and project variations are difficult to report when they live in separate files.",
      ],
    },
  ] satisfies IndustryItem[],
};

export const credibility = {
  eyebrow: "Why Rivqo",
  heading: "We understand the work behind the software.",
  body: "Rivqo was founded by people with direct experience inside engineering, procurement and technology businesses. Operational improvement is not another dashboard. It needs ownership, dependable data, appropriate controls, thoughtful integration and systems people will actually use.",
  scope:
    "We do not begin with a company-wide replacement, and we do not publish case studies or results until they are verified.",
  pillars: [
    {
      title: "Industry understanding",
      body: "Firsthand exposure to engineering, procurement and project-based operations.",
    },
    {
      title: "Technical depth",
      body: "Experience designing financial, workflow, integration and data-intensive systems.",
    },
    {
      title: "Controlled delivery",
      body: "A diagnostic-first approach that limits risk and measures improvement before expansion.",
    },
  ] satisfies CredibilityPillar[],
  caseStudies: [] as CaseStudy[],
};

export const start = {
  eyebrow: "Start with one operating problem",
  heading: "Find the workflow costing your company the most.",
  support:
    "Begin with a focused conversation about the process creating the most delay, leakage, rework or management uncertainty. If Rivqo is a suitable fit, the next step is a paid Project & Procurement Control Diagnostic.",
};

export const enquiryRoles: EnquiryFieldOption[] = [
  { value: "executive", label: "Executive" },
  { value: "operations", label: "Operations" },
  { value: "procurement", label: "Procurement" },
  { value: "finance", label: "Finance and audit" },
  { value: "systems", label: "IT and systems" },
  { value: "other", label: "Other" },
];

export const enquiryIndustries: EnquiryFieldOption[] = [
  { value: "epc", label: "Electrical and power EPC" },
  { value: "renewables", label: "Renewable-energy delivery" },
  { value: "oilandgas", label: "Oil-and-gas services and procurement" },
  { value: "maintenance", label: "Industrial maintenance" },
  { value: "consultancy", label: "Engineering and technical consultancy" },
  { value: "other", label: "Other" },
];

export const enquiryChallenges: EnquiryFieldOption[] = [
  { value: "approvals", label: "Approvals and accountability" },
  { value: "procurement", label: "Procurement and vendor control" },
  { value: "cost", label: "Project-cost visibility" },
  { value: "evidence", label: "Delivery and invoice evidence" },
  { value: "reporting", label: "Operational reporting" },
  { value: "integration", label: "Systems integration" },
  { value: "other", label: "Other" },
];
