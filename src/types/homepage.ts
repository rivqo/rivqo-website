import type { LucideIcon } from "lucide-react";

export type StatusTone = "neutral" | "ok" | "warning" | "critical";

export type FlowNode = {
  id: string;
  code: string;
  label: string;
  status: string;
  tone: StatusTone;
};

export type ProblemItem = {
  title: string;
  detail: string;
};

export type RoleOutcome = {
  id: string;
  label: string;
  question: string;
  problem: string;
  outcome: string;
  interfaceTitle: string;
  interfaceRows: Array<{
    label: string;
    status: string;
    tone: StatusTone;
  }>;
};

export type CapabilityItem = {
  id: string;
  title: string;
  outcome: string;
  examples: [string, string, string];
  icon: LucideIcon;
};

export type ConnectedItem = {
  id: string;
  label: string;
};

export type MethodStage = {
  id: string;
  number: string;
  title: string;
  body: string;
};

export type IndustryItem = {
  id: string;
  title: string;
  realities: [string] | [string, string];
};

export type CredibilityPillar = {
  title: string;
  body: string;
};

export type CaseStudy = {
  title: string;
  summary: string;
};

export type EnquiryFieldOption = {
  value: string;
  label: string;
};
