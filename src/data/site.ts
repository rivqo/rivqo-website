import type { SiteContent } from "@/types/site";

export const site: SiteContent = {
  name: "Rivqo",
  legalName: "Rivqo Digital LTD",
  url: "https://rivqo.com",
  positioning:
    "Rivqo helps engineering, energy and industrial-service companies improve procurement, project visibility, approvals, reconciliation and operational reporting.",
  navigation: [
    { label: "Solutions", href: "/solutions", status: "confirmed" },
    { label: "Method", href: "/method", status: "confirmed" },
    { label: "Industries", href: "/industries", status: "confirmed" },
    { label: "About", href: "/about", status: "confirmed" },
  ],
  cta: {
    label: "Start a conversation",
    href: "/contact",
    status: "confirmed",
  },
  contact: {
    status: "confirmed",
    note: "Phone and physical address have not been confirmed. Do not publish invented values.",
    email: "ola@rivqo.com",
    phone: null,
    address: null,
  },
};
