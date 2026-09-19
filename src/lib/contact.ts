import { site } from "@/data/site";

export const enquirySubject = "Operational improvement enquiry";

export function publicEmail() {
  return site.contact.email ?? "";
}

export function enquiryMailto() {
  const email = publicEmail();
  return `mailto:${email}?subject=${encodeURIComponent(enquirySubject)}`;
}
