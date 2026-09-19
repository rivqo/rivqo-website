import type { FitList, MethodDetail } from "@/types/pages";

export const methodPage = {
  title: "How We Work — Rivqo",
  description:
    "Rivqo starts with one operational problem, proves improvement in a bounded pilot, then expands with evidence. Suitable work normally begins with a paid diagnostic.",
  eyebrow: "Evidence before expansion",
  heading:
    "Start with one operational problem. Prove improvement before scaling.",
  headingLines: [
    "Start with one operational problem. ",
    "Prove improvement before scaling.",
  ],
  introduction:
    "Rivqo does not open with a company-wide transformation programme. Work begins with one workflow that is already costing time, money or management attention. Each stage should be useful on its own.",
};

export const methodDetails: MethodDetail[] = [
  {
    id: "diagnose",
    number: "01",
    title: "Diagnose",
    summary:
      "The Project & Procurement Control Diagnostic maps how work actually moves today, where control fails, and which improvement is worth proving first. It is paid work. The outputs are independently useful even if Rivqo is not asked to implement the next stage.",
    activities: [
      "Stakeholder interviews",
      "Workflow observation",
      "Evidence review",
      "Current-state mapping",
      "Baseline measurement",
      "Control assessment",
      "Target workflow",
      "Pilot recommendation",
    ],
    outputs: [
      "Executive decision brief",
      "Current-state workflow",
      "Pain and control register",
      "Baseline measures",
      "Target operating workflow",
      "Pilot charter",
      "Implementation roadmap",
    ],
  },
  {
    id: "prove",
    number: "02",
    title: "Prove",
    summary:
      "A controlled pilot tests the target workflow with a limited group before the company is asked to change more widely.",
    points: [
      "One workflow",
      "Defined users or project group",
      "Limited integrations",
      "Named sponsor and process owner",
      "Agreed success measures",
      "Adoption and acceptance",
    ],
  },
  {
    id: "deploy",
    number: "03",
    title: "Deploy",
    summary:
      "Rollout extends only what the pilot has shown can hold. Scope stays written down.",
    points: [
      "Additional users",
      "Relevant projects or locations",
      "Approved integrations",
      "Training",
      "Data work",
      "Governance",
      "Support transition",
    ],
  },
  {
    id: "improve",
    number: "04",
    title: "Improve",
    summary:
      "After the workflow is in use, Rivqo can help keep it healthy. Automation and AI are considered only where the data and process can support them.",
    points: [
      "Monitoring",
      "Support",
      "Configuration",
      "Integration health",
      "Reporting",
      "Adoption",
      "Controlled automation",
      "AI only where data and processes justify it",
    ],
  },
];

export const deliveryJourney = {
  heading: "The delivery journey",
  introduction:
    "Each stage should leave something the company can use. Prioritise is the selection that comes out of the diagnostic, not a separate unpaid study.",
  stages: [
    {
      id: "diagnose",
      number: "01",
      title: "Diagnose",
      href: "/method#diagnose",
      output: "Process map",
      artifact: "current-state",
      note: "How work actually moves, and where control fails.",
    },
    {
      id: "prioritise",
      number: "02",
      title: "Prioritise",
      href: "/method#diagnose",
      output: "Opportunity register",
      artifact: "register",
      note: "The diagnostic names one workflow worth proving first.",
    },
    {
      id: "prove",
      number: "03",
      title: "Prove",
      href: "/method#prove",
      output: "Prototype or pilot",
      artifact: "pilot",
      note: "A bounded group tests the target path before wider change.",
    },
    {
      id: "deploy",
      number: "04",
      title: "Deploy",
      href: "/method#deploy",
      output: "Integrated workflow",
      artifact: "workflow",
      note: "Only what the pilot held is extended, with scope written down.",
    },
    {
      id: "improve",
      number: "05",
      title: "Improve",
      href: "/method#improve",
      output: "Performance review",
      artifact: "review",
      note: "The path stays healthy. Automation waits for the record.",
    },
  ],
} as const;

export const methodNeeds = {
  title: "What Rivqo needs from the client",
  body: "The diagnostic is not a substitute for the company’s own knowledge of its work. Rivqo needs enough access to see the workflow as it is run, not as it is described in a slide.",
  items: [
    "A sponsor who can make the problem visible to leadership",
    "A process owner who lives with the workflow",
    "Time with the people who raise requests, approve them, buy, deliver and reconcile",
    "Sample evidence: requests, orders, cost files, exception lists and recent reports",
    "Willingness to change a process that is already failing",
  ],
};

export const methodScope = {
  title: "How scope is controlled",
  body: "Scope is written before it expands. The diagnostic recommends a pilot. The pilot charter names users, integrations and success measures. Later work is a separate decision.",
  items: [
    "One operational problem first",
    "Named integrations only",
    "No open-ended discovery in place of a paid diagnostic",
    "Expansion after the pilot can be assessed",
  ],
};

export const methodLimits = {
  title: "What Rivqo does not promise",
  items: [
    "Guaranteed savings, cycle-time cuts or a fixed return",
    "A company-wide system replacement as the first move",
    "A full ERP decision before priorities are agreed",
    "Extensive unpaid discovery",
    "AI or automation as a substitute for ownership, data and controls",
  ],
};

export const goodFit: FitList = {
  title: "Indicators that the engagement is a good fit",
  items: [
    "Several active projects or sites",
    "Recurring procurement",
    "Fragmented operational records",
    "Manual management reporting",
    "An executive-visible problem",
    "A willing sponsor and process owner",
    "Ability to begin with a paid diagnostic",
  ],
};

export const poorFit: FitList = {
  title: "Indicators that Rivqo may not be the right fit",
  items: [
    "The requirement is mainly a cheap website or basic application",
    "No recognised operational problem",
    "No sponsor or process owner",
    "Expectation of extensive unpaid discovery",
    "Demand for a full ERP before agreeing priorities",
    "Refusal to change a broken process",
  ],
};
