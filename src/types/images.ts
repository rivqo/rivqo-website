export type ImageReadiness =
  | "confirmed"
  | "awaiting-real-asset"
  | "suitable-for-original-artwork"
  | "decorative-only"
  | "do-not-use";

export type ImagePermission = "owned" | "licensed" | "pending" | "generated";

export type ImageTreatment = "plain" | "plate" | "mono" | "charcoal" | "edge";

export type ImageFocal =
  | "center"
  | "top"
  | "bottom"
  | "left"
  | "right"
  | "top-left"
  | "top-right"
  | "bottom-left"
  | "bottom-right";

export type SiteImage = {
  id: string;
  src: string;
  width: number;
  height: number;
  aspectRatio: string;
  alt: string;
  decorative: boolean;
  focal: ImageFocal;
  credit?: string;
  permission: ImagePermission;
  pages: string[];
  readiness: "confirmed";
  caption?: string;
  contextLabel?: string;
  treatment?: ImageTreatment;
};

export type ImagePlacementId =
  | "industry-epc"
  | "industry-renewables"
  | "industry-oilandgas"
  | "industry-maintenance"
  | "industry-consultancy"
  | "method-workshop"
  | "about-founder-1"
  | "about-founder-2"
  | "about-session"
  | "credibility-session";
