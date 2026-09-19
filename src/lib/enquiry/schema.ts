import { z } from "zod";
import {
  enquiryChallengeValues,
  enquiryIndustryValues,
  enquiryRoleValues,
} from "@/lib/enquiry/options";

export const MIN_SUBMISSION_MS = 800;
export const MAX_ENQUIRY_BYTES = 8_192;

export const enquiryFieldSchema = z.object({
  name: z.string().trim().min(2).max(100),
  email: z.email().max(254),
  company: z.string().trim().min(2).max(150),
  role: z.enum(enquiryRoleValues),
  industry: z.enum(enquiryIndustryValues),
  challenge: z.enum(enquiryChallengeValues),
  message: z.string().trim().max(2000).default(""),
});

export const enquirySubmissionSchema = enquiryFieldSchema.extend({
  website: z.string().max(0),
  startedAt: z.coerce.number().int().positive(),
});

export type EnquiryFields = z.infer<typeof enquiryFieldSchema>;

export function parseEnquiryInput(input: unknown) {
  return enquirySubmissionSchema.safeParse(input);
}
