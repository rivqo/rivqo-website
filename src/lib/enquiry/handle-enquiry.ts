import { enquiryCopy } from "@/lib/enquiry/copy";
import { enquiryDeliveryEnabled } from "@/lib/enquiry/delivery";
import { buildEnquiryMail, type EnquiryMailer } from "@/lib/enquiry/mailer";
import { defaultRateLimiter, type RateLimiter } from "@/lib/enquiry/rate-limit";
import { resolveMailer } from "@/lib/enquiry/resend";
import {
  MAX_ENQUIRY_BYTES,
  MIN_SUBMISSION_MS,
  parseEnquiryInput,
  type EnquiryFields,
} from "@/lib/enquiry/schema";

export type EnquiryActionStatus =
  "success" | "invalid" | "delivery_failed" | "rate_limited";

export type EnquiryActionResult = {
  status: EnquiryActionStatus;
  message: string;
  fieldErrors?: Partial<Record<keyof EnquiryFields, string>>;
};

export type EnquiryHandlerDeps = {
  mailer?: EnquiryMailer;
  limiter?: RateLimiter;
  now?: () => number;
  origin?: string | null;
  host?: string | null;
  clientKey?: string;
};

function sameOrigin(
  origin: string | null | undefined,
  host: string | null | undefined,
) {
  if (!origin || !host) {
    return true;
  }

  try {
    return new URL(origin).host === host;
  } catch {
    return false;
  }
}

function fieldErrorsFromZod(
  error: ReturnType<typeof parseEnquiryInput>["error"],
): NonNullable<EnquiryActionResult["fieldErrors"]> {
  const fieldErrors: NonNullable<EnquiryActionResult["fieldErrors"]> = {};

  if (!error) {
    return fieldErrors;
  }

  for (const issue of error.issues) {
    const key = issue.path[0];
    if (
      key === "name" ||
      key === "email" ||
      key === "company" ||
      key === "role" ||
      key === "industry" ||
      key === "challenge" ||
      key === "message"
    ) {
      fieldErrors[key] = enquiryCopy.invalid;
    }
  }

  return fieldErrors;
}

export async function handleEnquiry(
  input: unknown,
  deps: EnquiryHandlerDeps = {},
): Promise<EnquiryActionResult> {
  const now = deps.now ?? Date.now;
  const mailer = deps.mailer ?? resolveMailer();
  const limiter = deps.limiter ?? defaultRateLimiter;

  const serialized = JSON.stringify(input ?? {});
  if (serialized.length > MAX_ENQUIRY_BYTES) {
    return { status: "invalid", message: enquiryCopy.invalid };
  }

  if (!sameOrigin(deps.origin, deps.host)) {
    return { status: "invalid", message: enquiryCopy.invalid };
  }

  const parsed = parseEnquiryInput(input);
  if (!parsed.success) {
    return {
      status: "invalid",
      message: enquiryCopy.invalid,
      fieldErrors: fieldErrorsFromZod(parsed.error),
    };
  }

  if (parsed.data.website.length > 0) {
    return { status: "invalid", message: enquiryCopy.invalid };
  }

  if (now() - parsed.data.startedAt < MIN_SUBMISSION_MS) {
    return { status: "invalid", message: enquiryCopy.invalid };
  }

  const limit = await limiter.consume(deps.clientKey ?? "anonymous");
  if (!limit.allowed) {
    return { status: "rate_limited", message: enquiryCopy.rateLimited };
  }

  if (!deps.mailer && !enquiryDeliveryEnabled()) {
    return { status: "delivery_failed", message: enquiryCopy.unavailable };
  }

  const mail = buildEnquiryMail(parsed.data, new Date(now()));
  if (!deps.mailer && (!mail.to || !mail.from)) {
    return { status: "delivery_failed", message: enquiryCopy.failure };
  }

  try {
    const result = await mailer.send(mail);
    if (!result.accepted) {
      return { status: "delivery_failed", message: enquiryCopy.failure };
    }
  } catch {
    return { status: "delivery_failed", message: enquiryCopy.failure };
  }

  return { status: "success", message: enquiryCopy.success };
}
