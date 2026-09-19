import { existsSync } from "node:fs";
import { join } from "node:path";
import { describe, expect, it } from "vitest";
import { siteImages } from "@/data/images";
import { confirmedImages, getConfirmedImage } from "@/lib/images";

describe("image manifest", () => {
  it("lists only confirmed files that exist on disk", () => {
    for (const image of siteImages) {
      expect(image.readiness).toBe("confirmed");
      expect(image.src.startsWith("/")).toBe(true);
      expect(image.src.includes("http")).toBe(false);
      expect(image.width).toBeGreaterThan(0);
      expect(image.height).toBeGreaterThan(0);

      const diskPath = join(
        process.cwd(),
        "public",
        image.src.replace(/^\//, ""),
      );
      expect(existsSync(diskPath), diskPath).toBe(true);
    }
  });

  it("confirms the five industry plates and leaves other placements empty", () => {
    expect(getConfirmedImage("industry-epc")?.src).toBe(
      "/images/industries/electrical-power-epc.webp",
    );
    expect(getConfirmedImage("industry-renewables")?.src).toBe(
      "/images/industries/renewable-energy-delivery.webp",
    );
    expect(getConfirmedImage("industry-oilandgas")?.src).toBe(
      "/images/industries/oil-gas-procurement.webp",
    );
    expect(getConfirmedImage("industry-maintenance")?.src).toBe(
      "/images/industries/industrial-maintenance.webp",
    );
    expect(getConfirmedImage("industry-consultancy")?.src).toBe(
      "/images/industries/engineering-consultancy.webp",
    );
    expect(getConfirmedImage("method-workshop")).toBeUndefined();
    expect(getConfirmedImage("about-founder-1")).toBeUndefined();
    expect(confirmedImages().map((image) => image.id)).toEqual([
      "brand-logo",
      "brand-mark",
      "industry-epc",
      "industry-renewables",
      "industry-oilandgas",
      "industry-maintenance",
      "industry-consultancy",
    ]);
  });
});
