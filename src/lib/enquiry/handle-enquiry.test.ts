import { describe, expect, it } from "vitest";
import { handleEnquiry } from "@/lib/enquiry/handle-enquiry";
import { buildEnquiryMail } from "@/lib/enquiry/mailer";
import { createMemoryRateLimiter } from "@/lib/enquiry/rate-limit";
import { createMockMailer } from "@/lib/enquiry/resend";
import { enquiryCopy } from "@/lib/enquiry/copy";
import { sanitizeAnalyticsProperties } from "@/lib/analytics/sanitize";

const validInput = {
  name: "Ada Okonkwo",
  email: "ada@example.com",
  company: "Northline Power",
  role: "operations" as const,
  industry: "epc" as const,
  challenge: "approvals" as const,
  message: "We need a named approval path.",
  website: "",
  startedAt: 1,
};

function nowFactory(value = 10_000) {
  return () => value;
}

describe("handleEnquiry", () => {
  it("accepts a valid payload and sends mail", async () => {
    const result = await handleEnquiry(validInput, {
      mailer: createMockMailer("success"),
      limiter: createMemoryRateLimiter(nowFactory()),
      now: nowFactory(),
    });

    expect(result.status).toBe("success");
    expect(result.message).toBe(enquiryCopy.success);
  });

  it("rejects an invalid email", async () => {
    const result = await handleEnquiry(
      { ...validInput, email: "not-an-email" },
      { mailer: createMockMailer("success"), now: nowFactory() },
    );

    expect(result.status).toBe("invalid");
    expect(result.fieldErrors?.email).toBeDefined();
  });

  it("rejects missing required fields", async () => {
    const result = await handleEnquiry(
      { ...validInput, name: "", company: "" },
      { mailer: createMockMailer("success"), now: nowFactory() },
    );

    expect(result.status).toBe("invalid");
  });

  it("rejects a name that exceeds the maximum length", async () => {
    const result = await handleEnquiry(
      { ...validInput, name: "A".repeat(101) },
      { mailer: createMockMailer("success"), now: nowFactory() },
    );

    expect(result.status).toBe("invalid");
  });

  it("rejects a filled honeypot", async () => {
    const result = await handleEnquiry(
      { ...validInput, website: "https://spam.example" },
      { mailer: createMockMailer("success"), now: nowFactory() },
    );

    expect(result.status).toBe("invalid");
  });

  it("rejects an obviously automated submission", async () => {
    const result = await handleEnquiry(
      { ...validInput, startedAt: 9_500 },
      { mailer: createMockMailer("success"), now: nowFactory(10_000) },
    );

    expect(result.status).toBe("invalid");
  });

  it("does not claim success when form delivery is disabled", async () => {
    const result = await handleEnquiry(validInput, {
      limiter: createMemoryRateLimiter(nowFactory()),
      now: nowFactory(),
    });

    expect(result.status).toBe("delivery_failed");
    expect(result.message).toBe(enquiryCopy.unavailable);
    expect(result.message).toContain("ola@rivqo.com");
  });

  it("returns delivery failure when the mailer does not accept the message", async () => {
    const result = await handleEnquiry(validInput, {
      mailer: createMockMailer("failure"),
      now: nowFactory(),
    });

    expect(result.status).toBe("delivery_failed");
    expect(result.message).toContain("ola@rivqo.com");
  });

  it("rate limits repeated attempts from the same key", async () => {
    const limiter = createMemoryRateLimiter(nowFactory());

    for (let index = 0; index < 5; index += 1) {
      await handleEnquiry(validInput, {
        mailer: createMockMailer("success"),
        limiter,
        now: nowFactory(),
        clientKey: "1.1.1.1",
      });
    }

    const result = await handleEnquiry(validInput, {
      mailer: createMockMailer("success"),
      limiter,
      now: nowFactory(),
      clientKey: "1.1.1.1",
    });

    expect(result.status).toBe("rate_limited");
  });
});

describe("buildEnquiryMail", () => {
  it("uses the company in the subject and never the visitor as from", () => {
    const mail = buildEnquiryMail(validInput, new Date("2026-09-19T12:00:00Z"));

    expect(mail.subject).toBe("New Rivqo enquiry — Northline Power");
    expect(mail.replyTo).toBe("ada@example.com");
    expect(mail.from).not.toBe("ada@example.com");
    expect(mail.html).not.toContain("<script>");
    expect(mail.text).toContain("Northline Power");
  });
});

describe("analytics sanitise", () => {
  it("drops personal and free-text fields", () => {
    const safe = sanitizeAnalyticsProperties({
      name: "Ada",
      email: "ada@example.com",
      company: "Northline",
      message: "secret",
      industry: "epc",
      challenge: "approvals",
    });

    expect(safe).toEqual({
      industry: "epc",
      challenge: "approvals",
    });
  });
});
