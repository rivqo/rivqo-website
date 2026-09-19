import type { IndustryDetail } from "@/types/pages";

export const industriesPage = {
  title: "Industries — Rivqo",
  description:
    "Rivqo works with project-based companies where procurement, project cost, approvals and delivery evidence must move together. The final engagement depends on diagnostic evidence.",
  eyebrow: "Project-based operations",
  heading:
    "For businesses where procurement, projects and delivery must move together.",
  headingLines: [
    "For businesses where procurement, ",
    "projects and delivery ",
    "must move together.",
  ],
  introduction:
    "These industries share a pattern: work happens across projects, vendors, sites and records that do not update together. The details differ. Rivqo does not assume that every company in an industry runs the same process.",
  disclaimer:
    "The final engagement depends on diagnostic evidence from the company, not on an industry template.",
};

export const industryDetails: IndustryDetail[] = [
  {
    id: "epc",
    title: "Electrical and power EPC",
    complexity:
      "Long-lead equipment, multi-contractor packages and site variations move faster than the files meant to record them. Client reporting then depends on people reconstructing status.",
    questions: [
      "Where does each package stand against procurement and delivery?",
      "Which commitments are already made against the project code?",
      "What evidence exists for a variation or a delayed item?",
    ],
    capabilities: [
      "Procurement and vendor control",
      "Project cost and progress visibility",
      "Approvals and document traceability",
      "Management reporting",
    ],
    workflow: [
      {
        code: "PKG-B",
        label: "Equipment package",
        status: "Vendor selected",
        tone: "ok",
      },
      {
        code: "SITE-3",
        label: "Site delivery",
        status: "Delivery delayed",
        tone: "critical",
      },
      {
        code: "SUB-09",
        label: "Subcontractor work",
        status: "Awaiting approval",
        tone: "warning",
      },
      {
        code: "RPT-12",
        label: "Client status",
        status: "Rebuild in progress",
        tone: "warning",
      },
    ],
    disclaimer:
      "Package structures, certification needs and client reporting differ by project. The diagnostic decides what, if anything, Rivqo should implement.",
  },
  {
    id: "renewables",
    title: "Renewable-energy delivery",
    complexity:
      "Equipment, contractors and commissioning windows are spread across sites. A missing document or late delivery can stall energisation even when the physical work is close to complete.",
    questions: [
      "Which sites are waiting on equipment, access or documentation?",
      "How current is installation progress against the plan?",
      "Can portfolio status be read without rebuilding it site by site?",
    ],
    capabilities: [
      "Procurement and vendor control",
      "Project cost and progress visibility",
      "Approvals and document traceability",
      "Management reporting",
    ],
    workflow: [
      {
        code: "EQ-18",
        label: "Equipment sourcing",
        status: "On order",
        tone: "ok",
      },
      {
        code: "SITE-A",
        label: "Installation",
        status: "Progress behind",
        tone: "warning",
      },
      {
        code: "COM-04",
        label: "Commissioning pack",
        status: "Document missing",
        tone: "critical",
      },
      {
        code: "PF-02",
        label: "Portfolio view",
        status: "Manual consolidate",
        tone: "warning",
      },
    ],
    disclaimer:
      "Site count, contracting model and commissioning requirements vary. Rivqo does not treat every renewable-energy company as the same operation.",
  },
  {
    id: "oilandgas",
    title: "Oil-and-gas services and procurement",
    complexity:
      "High-value materials, third-party services and client documentation requirements make an incomplete trail expensive. Mobilisation and inventory decisions depend on records that are often split.",
    questions: [
      "Can a request be followed through vendor, contract and delivery evidence?",
      "Which items are committed, on site, or still unmatched?",
      "Is the project accounting trail complete enough to stand review?",
    ],
    capabilities: [
      "Procurement and vendor control",
      "Reconciliation and exception management",
      "Approvals and document traceability",
      "Systems integration and automation",
    ],
    workflow: [
      {
        code: "VN-44",
        label: "Vendor coordination",
        status: "Contract in review",
        tone: "warning",
      },
      {
        code: "MOB-2",
        label: "Mobilisation",
        status: "Waiting on evidence",
        tone: "critical",
      },
      {
        code: "INV-7",
        label: "Inventory position",
        status: "Unmatched line",
        tone: "warning",
      },
      {
        code: "PRJ-11",
        label: "Project accounting",
        status: "Code assigned",
        tone: "ok",
      },
    ],
    disclaimer:
      "Rivqo does not claim regulatory certifications or operator relationships. Suitability depends on the company’s actual workflow and evidence.",
  },
  {
    id: "maintenance",
    title: "Industrial maintenance",
    complexity:
      "Work orders, technicians, spare parts and service levels compress during shutdowns and emergencies. Invoicing then needs evidence that was hard to capture while the work was urgent.",
    questions: [
      "Which work orders are blocked on parts, access or approval?",
      "Is recurring work visible separately from emergency work?",
      "Can invoicing be tied to the evidence of what was done?",
    ],
    capabilities: [
      "Project cost and progress visibility",
      "Approvals and document traceability",
      "Reconciliation and exception management",
      "Management reporting",
    ],
    workflow: [
      {
        code: "WO-903",
        label: "Work order",
        status: "Parts outstanding",
        tone: "warning",
      },
      {
        code: "TECH-6",
        label: "Technician assignment",
        status: "Owner named",
        tone: "ok",
      },
      {
        code: "SP-118",
        label: "Spare part",
        status: "Awaiting approval",
        tone: "warning",
      },
      {
        code: "INV-77",
        label: "Invoice evidence",
        status: "Document missing",
        tone: "critical",
      },
    ],
    disclaimer:
      "Shutdown practice, asset registers and service-level agreements differ. The diagnostic establishes what the company actually needs.",
  },
  {
    id: "consultancy",
    title: "Engineering and technical consultancy",
    complexity:
      "Allocation, reviews, timesheets, subcontracted specialists and invoicing often sit in separate files. Portfolio profitability is then inferred rather than read.",
    questions: [
      "Which projects are consuming time without a clear deliverable status?",
      "Where are reviews and approvals holding release?",
      "Can invoicing and profitability be tied to the same project record?",
    ],
    capabilities: [
      "Project cost and progress visibility",
      "Approvals and document traceability",
      "Management reporting",
      "Systems integration and automation",
    ],
    workflow: [
      {
        code: "AL-21",
        label: "Project allocation",
        status: "Over-committed",
        tone: "warning",
      },
      {
        code: "DEL-8",
        label: "Deliverable review",
        status: "Awaiting approval",
        tone: "warning",
      },
      {
        code: "TS-14",
        label: "Timesheet to project",
        status: "Unmatched hours",
        tone: "critical",
      },
      {
        code: "PF-05",
        label: "Portfolio reporting",
        status: "Manual rebuild",
        tone: "neutral",
      },
    ],
    disclaimer:
      "Fee models, review gates and subcontracting arrangements are not uniform. Rivqo starts from the company’s records, not from a generic consultancy template.",
  },
];
