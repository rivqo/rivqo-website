import type { SolutionArea } from "@/types/pages";

export const solutionsPage = {
  title: "Solutions — Rivqo",
  description:
    "Rivqo improves the process, ownership, information and system connections behind project delivery—without beginning with a full ERP replacement.",
  eyebrow: "Operational improvement and systems implementation",
  heading:
    "Control the workflows that determine whether projects stay on track.",
  headingLines: [
    "Control the workflows that ",
    "determine whether projects ",
    "stay on track.",
  ],
  introduction:
    "Rivqo improves the process, ownership, information and system connections behind project delivery. We begin with the workflow that is causing the most delay, leakage or uncertainty. Rivqo does not begin by selling a full ERP replacement.",
  closer:
    "The right starting point depends on evidence from the current operation. The next useful step is to understand how Rivqo diagnoses one problem before expanding.",
};

export const solutionAreas: SolutionArea[] = [
  {
    id: "procurement",
    title: "Procurement and vendor control",
    problem:
      "Purchase requests, quotations, approvals, orders and delivery evidence often live in different files, inboxes and conversations. Status is reconstructed when someone asks, not held by the workflow.",
    improvement:
      "Rivqo may introduce a named path from request to commitment, with vendor comparison, approval, delivery documentation and a link to invoice or payment status. The aim is a trail people can follow, not a catalogue of unused fields.",
    outcome:
      "Trace procurement from request to delivery without rebuilding the story from separate files and messages.",
    covers: [
      "Purchase requests",
      "Specifications",
      "Quotations",
      "Vendor comparison",
      "Approval",
      "Purchase commitments",
      "Delivery",
      "Documentation",
      "Invoice and payment-status linkage",
      "Vendor performance",
    ],
    signals: [
      "Nobody can say where a request stands without calling several people.",
      "Vendor selection cannot be reconstructed after the order is placed.",
      "Delivery and invoice evidence arrive after payment pressure has started.",
    ],
    roles: ["Procurement", "Operations", "Finance", "Executive"],
    workflow: [
      {
        code: "PR-184",
        label: "Purchase request",
        status: "Awaiting approval",
        tone: "warning",
      },
      {
        code: "QT-62",
        label: "Vendor comparison",
        status: "Three quotations",
        tone: "ok",
      },
      {
        code: "PO-220",
        label: "Purchase commitment",
        status: "Issued",
        tone: "ok",
      },
      {
        code: "DL-441",
        label: "Delivery and evidence",
        status: "Document missing",
        tone: "critical",
      },
    ],
  },
  {
    id: "cost",
    title: "Project cost and progress visibility",
    problem:
      "Budgets, commitments, variations and site progress are often updated in different places. Leadership sees the cost position after the work has already moved.",
    improvement:
      "Rivqo may connect project coding, committed cost, actual-cost references, forecast inputs, milestones and blockers so the operating picture can be read while there is still time to act.",
    outcome: "See emerging cost and delivery problems early enough to act.",
    covers: [
      "Project coding",
      "Budgets",
      "Committed cost",
      "Actual cost references",
      "Forecast inputs",
      "Variations",
      "Milestones",
      "Materials",
      "Blockers",
      "Management status",
    ],
    signals: [
      "Committed cost is only reliable at month-end.",
      "Variations move on site before they appear in the cost file.",
      "Package status depends on whoever last answered a message.",
    ],
    roles: ["Operations", "Finance", "Executive", "Project controls"],
    workflow: [
      {
        code: "E-14",
        label: "Project budget",
        status: "Baseline held",
        tone: "ok",
      },
      {
        code: "CM-184",
        label: "Committed cost",
        status: "Order placed",
        tone: "warning",
      },
      {
        code: "VR-09",
        label: "Variation",
        status: "Awaiting approval",
        tone: "warning",
      },
      {
        code: "MS-07",
        label: "Milestone review",
        status: "Delivery delayed",
        tone: "critical",
      },
    ],
  },
  {
    id: "exceptions",
    title: "Reconciliation and exception management",
    problem:
      "Operational and financial records diverge. Missing documents, duplicates and conflicting statuses are investigated from scratch each time instead of being owned as exceptions.",
    improvement:
      "Rivqo may turn matching, missing evidence and unmatched transactions into a controlled queue with assigned ownership and a resolution history.",
    outcome:
      "Turn reconciliation from repeated investigation into a controlled exception process.",
    covers: [
      "Operational and financial record matching",
      "Missing documents",
      "Duplicate records",
      "Conflicting statuses",
      "Unmatched transactions",
      "Assigned exception ownership",
      "Resolution history",
    ],
    signals: [
      "The same mismatch is investigated more than once.",
      "Finance cannot tell whether a gap is a missing document or a real cost difference.",
      "Exceptions age because nobody is named as owner.",
    ],
    roles: ["Finance", "Procurement", "Operations", "Audit"],
    workflow: [
      {
        code: "INV-441",
        label: "Invoice match",
        status: "Document missing",
        tone: "critical",
      },
      {
        code: "PO-220",
        label: "Order and GRN",
        status: "Matched",
        tone: "ok",
      },
      {
        code: "EX-18",
        label: "Unmatched line",
        status: "Owner assigned",
        tone: "warning",
      },
      {
        code: "EX-12",
        label: "Duplicate record",
        status: "In review",
        tone: "neutral",
      },
    ],
  },
  {
    id: "approvals",
    title: "Approvals and document traceability",
    problem:
      "Decisions sit in inboxes and group chats. Limits, delegation and supporting documents are difficult to reconstruct when someone later asks who approved the work.",
    improvement:
      "Rivqo may replace inbox archaeology with approval limits, maker-checker separation, escalation, supporting documents and an audit history tied to a controlled status.",
    outcome: "Know who approved what, when, why and using which evidence.",
    covers: [
      "Approval limits",
      "Maker-checker separation",
      "Delegation",
      "Escalation",
      "Supporting documents",
      "Audit history",
      "Ownership",
      "Controlled status",
    ],
    signals: [
      "Approvals cannot be shown without searching personal mailboxes.",
      "Delegation happens informally and disappears when people change.",
      "Work proceeds while the supporting document set is still incomplete.",
    ],
    roles: ["Executive", "Finance", "Procurement", "Operations"],
    workflow: [
      {
        code: "AP-184",
        label: "Limit check",
        status: "Above threshold",
        tone: "warning",
      },
      {
        code: "MC-02",
        label: "Maker-checker",
        status: "Second review due",
        tone: "warning",
      },
      {
        code: "EV-441",
        label: "Supporting pack",
        status: "Document missing",
        tone: "critical",
      },
      {
        code: "AH-184",
        label: "Audit history",
        status: "Trail complete",
        tone: "ok",
      },
    ],
  },
  {
    id: "reporting",
    title: "Management reporting",
    problem:
      "Leadership updates are rebuilt from half-current files. Metric definitions drift, so two reports on the same week can disagree.",
    improvement:
      "Rivqo may give management a current operating view—portfolio status, procurement ageing, approval delays, commitments, exceptions and documentation completeness—using definitions people can share.",
    outcome:
      "Give management a current operating view without recurring manual consolidation.",
    covers: [
      "Project portfolio status",
      "Procurement ageing",
      "Approval delays",
      "Cost commitments",
      "Delivery exceptions",
      "Documentation completeness",
      "Reliable metric definitions",
    ],
    signals: [
      "Every leadership meeting starts with a new spreadsheet rebuild.",
      "Two teams report different figures for the same commitment.",
      "Exceptions are described in narrative, not as a current list.",
    ],
    roles: ["Executive", "Operations", "Finance", "Project controls"],
    workflow: [
      {
        code: "PF-03",
        label: "Portfolio status",
        status: "Three projects late",
        tone: "warning",
      },
      {
        code: "PR-AGE",
        label: "Procurement ageing",
        status: "Requests over 14 days",
        tone: "critical",
      },
      {
        code: "CM-SUM",
        label: "Cost commitments",
        status: "Current this week",
        tone: "ok",
      },
      {
        code: "DOC-12",
        label: "Evidence completeness",
        status: "Two packs open",
        tone: "warning",
      },
    ],
  },
  {
    id: "integration",
    title: "Systems integration and automation",
    problem:
      "Useful tools already exist, but the workflow still depends on re-keying, exported files and personal follow-up. A new system is often proposed before the connections are understood.",
    improvement:
      "Rivqo may connect accounting or ERP records, document repositories, identity, collaboration tools, imports, exports and notifications. Repetitive steps are automated only where the process can carry them.",
    outcome:
      "Connect the required workflow across existing tools before considering replacement.",
    covers: [
      "Accounting and ERP integration",
      "Document repositories",
      "Identity providers",
      "Collaboration tools",
      "Imports and exports",
      "Notifications",
      "Repetitive workflow automation",
    ],
    signals: [
      "The same record is typed into more than one system.",
      "A new tool is proposed because the last one was never connected.",
      "Notifications fire, but nobody owns the exception they describe.",
    ],
    roles: ["IT and systems", "Finance", "Operations", "Procurement"],
    workflow: [
      {
        code: "ACC",
        label: "Accounting system",
        status: "Keep and connect",
        tone: "ok",
      },
      {
        code: "DOC",
        label: "Evidence store",
        status: "Link required",
        tone: "warning",
      },
      {
        code: "ID",
        label: "Named access",
        status: "Owner mapped",
        tone: "ok",
      },
      {
        code: "AUTO",
        label: "Repetitive step",
        status: "Not yet justified",
        tone: "neutral",
      },
    ],
  },
];

export const systemsMap = {
  heading: "Connected operating systems",
  introduction:
    "Rivqo sits between the people, records and tools that already exist. The map is a way to read how those systems join. It is not a catalogue of separate products.",
  hub: "Rivqo connects the workflow across these systems.",
  systems: [
    {
      id: "project",
      label: "Project delivery",
      href: "/solutions#cost",
      related: ["procurement", "finance", "reporting", "workforce"],
      outcome:
        "Package status, commitments and blockers can be read without rebuilding the week from separate files.",
    },
    {
      id: "procurement",
      label: "Procurement",
      href: "/solutions#procurement",
      related: ["project", "finance", "erp"],
      outcome:
        "A request can be followed to vendor, commitment, delivery evidence and payment status.",
    },
    {
      id: "finance",
      label: "Finance and reconciliation",
      href: "/solutions#exceptions",
      related: ["procurement", "project", "reporting"],
      outcome:
        "Mismatches become a named exception queue instead of a repeated investigation.",
    },
    {
      id: "reporting",
      label: "Reporting and management visibility",
      href: "/solutions#reporting",
      related: ["project", "finance", "automation"],
      outcome:
        "Leadership can share one current operating view, using definitions people already agree.",
    },
    {
      id: "workforce",
      label: "Workforce and capacity",
      href: "/solutions#cost",
      related: ["project", "reporting"],
      outcome:
        "Who is assigned, blocked or over-committed stays on the same record as the work.",
    },
    {
      id: "erp",
      label: "CRM / ERP workflows",
      href: "/solutions#integration",
      related: ["procurement", "finance", "automation"],
      outcome:
        "Existing accounting, identity and document tools stay. The workflow is connected rather than re-keyed.",
    },
    {
      id: "automation",
      label: "Automation and AI-assisted knowledge",
      href: "/solutions#integration",
      related: ["erp", "reporting", "finance"],
      outcome:
        "Repetitive steps and retrieval wait until ownership, evidence and data can support them.",
    },
  ],
} as const;
