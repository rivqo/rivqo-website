import type { ContrastItem, Principle } from "@/types/pages";

export const aboutPage = {
  title: "About Rivqo",
  description:
    "Rivqo Digital LTD is an operations-improvement and systems implementation company for project-based businesses. Public case studies are published only when verified and permitted.",
  eyebrow: "Industry understanding and technical depth",
  heading: "We understand the work behind the software.",
  headingLines: ["We understand the work ", "behind the software."],
  positioning:
    "Rivqo Digital LTD is an operations-improvement and systems implementation company for project-based businesses.",
  founding:
    "Rivqo was founded from firsthand exposure to engineering operations, procurement businesses, software and systems development, financial and workflow systems, and data and integration problems.",
};

export const aboutExperience = {
  heading: "Where the practice comes from",
  introduction:
    "Rivqo was founded from three kinds of work meeting in one place. Names and portraits are published only when biography is also approved.",
  bands: [
    {
      id: "software",
      label: "Software engineering",
      items: [
        "Systems development",
        "Data and integration",
        "Workflow software",
      ],
    },
    {
      id: "operations",
      label: "Operational experience",
      items: [
        "Procurement businesses",
        "Financial and workflow systems",
        "Ownership and evidence",
      ],
    },
    {
      id: "industrial",
      label: "Industrial delivery",
      items: [
        "Engineering operations",
        "Project-based work",
        "Site and vendor records",
      ],
    },
  ],
  join: "Rivqo is the connecting practice: improve the process, then implement the system that can hold it.",
  industriesHeading: "Industry exposure",
  industries: [
    { href: "/industries#epc", label: "Electrical and power EPC" },
    { href: "/industries#renewables", label: "Renewable-energy delivery" },
    {
      href: "/industries#oilandgas",
      label: "Oil-and-gas services and procurement",
    },
    { href: "/industries#maintenance", label: "Industrial maintenance" },
    {
      href: "/industries#consultancy",
      label: "Engineering and technical consultancy",
    },
  ],
} as const;

export const aboutWhy = {
  title: "Why Rivqo exists",
  body: "Companies often have capable people and several tools but still lack dependable control across the complete workflow. The work continues. The record, the approval and the cost position do not stay together. Rivqo exists to improve that operating condition, not to add another disconnected interface.",
};

export const aboutPerspective = {
  title: "Rivqo’s perspective",
  body: "Technology does not fix unclear ownership, broken processes, unreliable data, missing controls or poor adoption. The implementation has to address these conditions together. A new screen on top of the same gaps becomes another place to re-key the same uncertainty.",
};

export const aboutPrinciples: Principle[] = [
  {
    title: "Evidence before features",
    body: "The current workflow, its failures and a baseline come before a feature list.",
  },
  {
    title: "Control before complexity",
    body: "Named ownership, limits and status matter more than an elaborate model.",
  },
  {
    title: "Integration before unnecessary replacement",
    body: "Connect the tools that already hold part of the record before proposing a new core.",
  },
  {
    title: "One accountable owner",
    body: "Each workflow and exception needs a person, not a shared inbox.",
  },
  {
    title: "Measurable improvement",
    body: "A pilot agrees what will be observed. Rivqo does not invent a result in advance.",
  },
  {
    title: "Security and traceability",
    body: "Who changed what, and with which evidence, has to remain reconstructable.",
  },
  {
    title: "Adoption as part of delivery",
    body: "A process that people will not use is not an implemented process.",
  },
  {
    title: "AI after dependable data and workflows",
    body: "Automation and AI wait until the record and ownership can support them.",
  },
];

export const aboutContrast: ContrastItem[] = [
  {
    title: "Generic custom software agencies",
    body: "A build can be technically sound and still leave the operating problem untouched if ownership, evidence and adoption are out of scope.",
  },
  {
    title: "Large ERP programmes",
    body: "A company-wide replacement can be the right later decision. Rivqo does not treat it as the first move when one workflow is already failing.",
  },
  {
    title: "Standalone dashboard projects",
    body: "A dashboard that reads incomplete sources gives leadership a confident picture of an unreliable record.",
  },
  {
    title: "Automation without process discipline",
    body: "Automating a broken path makes the same exception arrive faster.",
  },
  {
    title: "AI-first consulting",
    body: "Rivqo does not begin with a model. It begins with the workflow, the data it produces and the people who must use it.",
  },
];

export const aboutProof = {
  title: "Current proof boundary",
  body: "Rivqo’s public case-study library is still being developed. We do not publish client names, results or claims without verification and permission.",
};
