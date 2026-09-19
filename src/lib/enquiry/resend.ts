import { Resend } from "resend";
import type { EnquiryMail, EnquiryMailer } from "@/lib/enquiry/mailer";

export function createResendMailer(
  apiKey = process.env.RESEND_API_KEY,
): EnquiryMailer {
  return {
    async send(mail: EnquiryMail) {
      if (!apiKey) {
        return { accepted: false };
      }

      const resend = new Resend(apiKey);
      const result = await resend.emails.send({
        from: mail.from,
        to: mail.to,
        replyTo: mail.replyTo,
        subject: mail.subject,
        text: mail.text,
        html: mail.html,
      });

      return { accepted: !result.error };
    },
  };
}

export function createMockMailer(
  outcome: "success" | "failure" = "success",
): EnquiryMailer {
  return {
    async send() {
      return { accepted: outcome === "success" };
    },
  };
}

export function resolveMailer(): EnquiryMailer {
  const mode = process.env.ENQUIRY_TEST_MODE;

  if (process.env.NODE_ENV === "test" && mode === "mock-success") {
    return createMockMailer("success");
  }

  if (process.env.NODE_ENV === "test" && mode === "mock-failure") {
    return createMockMailer("failure");
  }

  return createResendMailer();
}
