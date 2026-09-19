export const enquiryRoleValues = [
  "executive",
  "operations",
  "procurement",
  "finance",
  "systems",
  "other",
] as const;

export const enquiryIndustryValues = [
  "epc",
  "renewables",
  "oilandgas",
  "maintenance",
  "consultancy",
  "other",
] as const;

export const enquiryChallengeValues = [
  "approvals",
  "procurement",
  "cost",
  "evidence",
  "reporting",
  "integration",
  "other",
] as const;

export type EnquiryRoleValue = (typeof enquiryRoleValues)[number];
export type EnquiryIndustryValue = (typeof enquiryIndustryValues)[number];
export type EnquiryChallengeValue = (typeof enquiryChallengeValues)[number];
