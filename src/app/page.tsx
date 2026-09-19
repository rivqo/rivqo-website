import { createPageMetadata } from "@/lib/metadata";
import { site } from "@/data/site";
import { CapabilitiesSection } from "@/components/sections/capabilities-section";
import { ConnectedViewSection } from "@/components/sections/connected-view-section";
import { CredibilitySection } from "@/components/sections/credibility-section";
import { HeroSection } from "@/components/sections/hero-section";
import { IndustriesSection } from "@/components/sections/industries-section";
import { MethodSection } from "@/components/sections/method-section";
import { ProblemsSection } from "@/components/sections/problems-section";
import { RoleOutcomes } from "@/components/sections/role-outcomes";
import { StartSection } from "@/components/sections/start-section";

export const metadata = createPageMetadata({
  title: `${site.name} — Operational Control for Project-Based Companies`,
  description: site.positioning,
  path: "/",
});

export default function Home() {
  return (
    <main id="main-content">
      <HeroSection />
      <ProblemsSection />
      <RoleOutcomes />
      <CapabilitiesSection />
      <ConnectedViewSection />
      <MethodSection />
      <IndustriesSection />
      <CredibilitySection />
      <StartSection />
    </main>
  );
}
