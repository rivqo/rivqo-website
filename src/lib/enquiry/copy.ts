import { site } from "@/data/site";

export const enquiryCopy = {
  success:
    "Thank you. Your enquiry has been sent to Rivqo. We’ll review it and respond using the work email you provided.",
  failure: `We couldn’t send your enquiry right now. Please try again or email ${site.contact.email} directly.`,
  unavailable: `The form is not delivering messages yet. Email ${site.contact.email} directly.`,
  rateLimited: `We received several enquiries from this connection. Please wait a few minutes or email ${site.contact.email} directly.`,
  invalid: "Check the highlighted fields and try again.",
  privacy:
    "Rivqo will use the information you provide only if a message is actually delivered. Until form delivery is connected, email is the dependable contact route.",
} as const;
