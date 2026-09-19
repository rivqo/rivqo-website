import { Breadcrumbs } from "@/components/layout/breadcrumbs";
import { Container } from "@/components/layout/container";
import { Entrance } from "@/components/motion/entrance";
import { HeroHeadline } from "@/components/motion/text-reveal";
import { JsonLd, breadcrumbJsonLd } from "@/lib/json-ld";
import type { BreadcrumbItem } from "@/types/pages";

type PageHeroProps = {
  eyebrow: string;
  heading: string;
  headingLines?: string[];
  headingId?: string;
  children?: React.ReactNode;
  crumbs: BreadcrumbItem[];
};

export function PageHero({
  eyebrow,
  heading,
  headingLines,
  headingId = "page-heading",
  children,
  crumbs,
}: PageHeroProps) {
  return (
    <header className="page-hero relative border-b border-border">
      <JsonLd data={breadcrumbJsonLd(crumbs)} />
      <div
        aria-hidden="true"
        className="hero-grid pointer-events-none absolute inset-0"
      />
      <Container className="relative section-space">
        <Entrance delay={0.02} y={12}>
          <Breadcrumbs items={crumbs} />
        </Entrance>
        <Entrance delay={0.08} y={16}>
          <p className="font-mono text-label text-primary">{eyebrow}</p>
        </Entrance>
        <HeroHeadline
          id={headingId}
          className="mt-4 max-w-4xl"
          lines={headingLines ?? [heading]}
        />
        {children ? (
          <Entrance delay={0.2} y={18}>
            <div className="mt-6 max-w-2xl text-lede text-muted-foreground">
              {children}
            </div>
          </Entrance>
        ) : null}
      </Container>
    </header>
  );
}
