import { enquiryMailto, publicEmail } from "@/lib/contact";
import { Button } from "@/components/ui/button";

type ContactCtaProps = {
  label?: string;
  cta?: string;
  showFallback?: boolean;
};

export function ContactCta({
  label = "Email Rivqo",
  cta = "email-rivqo",
  showFallback = true,
}: ContactCtaProps) {
  const email = publicEmail();
  const href = enquiryMailto();

  if (!email) {
    return null;
  }

  return (
    <div>
      <Button href={href} data-cta={cta}>
        {label}
      </Button>
      {showFallback ? (
        <p className="mt-4 text-sm text-muted-foreground">
          Or write to{" "}
          <a href={href} className="underline underline-offset-2">
            {email}
          </a>
          .
        </p>
      ) : null}
    </div>
  );
}
