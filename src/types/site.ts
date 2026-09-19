export type NavigationStatus = "placeholder" | "confirmed";

export type NavigationItem = {
  label: string;
  href: string;
  status: NavigationStatus;
};

export type ContactDetails = {
  status: "needs-confirmation" | "confirmed";
  note: string;
  email: string | null;
  phone: string | null;
  address: string | null;
};

export type SiteContent = {
  name: string;
  legalName: string;
  url: string;
  positioning: string;
  navigation: NavigationItem[];
  cta: NavigationItem;
  contact: ContactDetails;
};
