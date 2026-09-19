import { Container } from "@/components/layout/container";
import { SectionReveal } from "@/components/motion/section-reveal";
import { Button } from "@/components/ui/button";
import { enquiryMailto, publicEmail } from "@/lib/contact";

type RelatedAction = {
  href: string;
  label: string;
  variant?: "primary" | "secondary";
  cta?: string;
};

type RelatedCtaProps = {
  eyebrow?: string;
  heading: string;
  children?: React.ReactNode;
  actions: RelatedAction[];
  dark?: boolean;
};

export function RelatedCta({
  eyebrow,
  heading,
  children,
  actions,
  dark = false,
}: RelatedCtaProps) {
  return (
    <section className={dark ? "surface-dark" : "border-t border-border"}>
      <Container className="section-space">
        <SectionReveal pattern="assemble" className="max-w-2xl">
          {eyebrow ? (
            <p className="font-mono text-label text-primary">{eyebrow}</p>
          ) : null}
          <h2 className="mt-3">{heading}</h2>
          {children ? (
            <div className="mt-5 text-lede text-muted-foreground">
              {children}
            </div>
          ) : null}
          <div className="mt-8 flex flex-wrap gap-3">
            {actions.map((action) => (
              <Button
                key={action.href}
                href={action.href}
                variant={action.variant ?? "primary"}
                data-cta={action.cta}
              >
                {action.label}
              </Button>
            ))}
          </div>
          {actions.some((action) => action.href === "/contact") &&
          publicEmail() ? (
            <p className="mt-5 text-sm text-muted-foreground">
              Or email{" "}
              <a
                href={enquiryMailto()}
                className="underline underline-offset-2"
              >
                {publicEmail()}
              </a>{" "}
              directly.
            </p>
          ) : null}
        </SectionReveal>
      </Container>
    </section>
  );
}
