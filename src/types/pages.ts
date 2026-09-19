import type { StatusTone } from "@/types/homepage";

export type BreadcrumbItem = {
  label: string;
  href: string;
};

export type WorkflowNode = {
  code: string;
  label: string;
  status: string;
  tone: StatusTone;
};

export type SolutionArea = {
  id: string;
  title: string;
  problem: string;
  improvement: string;
  outcome: string;
  covers: string[];
  signals: string[];
  roles: string[];
  workflow: WorkflowNode[];
};

export type MethodDetail = {
  id: string;
  number: string;
  title: string;
  summary: string;
  activities?: string[];
  outputs?: string[];
  points?: string[];
};

export type FitList = {
  title: string;
  items: string[];
};

export type IndustryDetail = {
  id: string;
  title: string;
  complexity: string;
  questions: string[];
  capabilities: string[];
  workflow: WorkflowNode[];
  disclaimer: string;
};

export type Principle = {
  title: string;
  body: string;
};

export type ContrastItem = {
  title: string;
  body: string;
};
