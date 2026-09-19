import type { MetadataRoute } from "next";
import { site } from "@/data/site";

const paths = [
  "/",
  "/solutions",
  "/method",
  "/industries",
  "/about",
  "/contact",
  "/privacy",
] as const;

export default function sitemap(): MetadataRoute.Sitemap {
  return paths.map((path) => ({
    url: new URL(path, site.url).toString(),
    changeFrequency: path === "/" ? "weekly" : "monthly",
    priority: path === "/" ? 1 : 0.7,
  }));
}
