import { siteImages } from "@/data/images";
import type { SiteImage } from "@/types/images";

const imagesById = new Map<string, SiteImage>(
  siteImages.map((image) => [image.id, image]),
);

export function getConfirmedImage(id: string): SiteImage | undefined {
  const image = imagesById.get(id);
  return image?.readiness === "confirmed" ? image : undefined;
}

export function confirmedImages(): SiteImage[] {
  return siteImages.filter((image) => image.readiness === "confirmed");
}

export function objectPosition(focal: SiteImage["focal"]) {
  switch (focal) {
    case "top":
      return "50% 0%";
    case "bottom":
      return "50% 100%";
    case "left":
      return "0% 50%";
    case "right":
      return "100% 50%";
    case "top-left":
      return "0% 0%";
    case "top-right":
      return "100% 0%";
    case "bottom-left":
      return "0% 100%";
    case "bottom-right":
      return "100% 100%";
    default:
      return "50% 50%";
  }
}
