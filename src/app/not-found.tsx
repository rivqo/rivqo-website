import type { Metadata } from "next";
import Link from "next/link";
import { Container } from "@/components/layout/container";
import { Button } from "@/components/ui/button";
import { site } from "@/data/site";
import { enquiryMailto, publicEmail } from "@/lib/contact";

export const metadata: Metadata = {
  title: {
    absolute: "Page not found — Rivqo",
  },
  description: "This page is not available on rivqo.com.",
  robots: {
    index: false,
    follow: true,
  },
};

export default function NotFound() {
  const email = publicEmail();

  return (
    <main id="main-content" className="section-space">
      <Container width="narrow">
        <p className="font-mono text-label text-primary">404</p>
        <h1 className="mt-3">This page is not available.</h1>
        <p className="mt-5 text-lede text-muted-foreground">
          The address may have changed, or it may never have been part of the
          public site. Use the pages below, or write to {site.legalName}{" "}
          directly.
        </p>
        <div className="mt-10 flex flex-wrap gap-3">
          <Button href="/" data-cta="not-found-home">
            Rivqo home
          </Button>
          <Button
            href="/contact"
            variant="secondary"
            data-cta="not-found-contact"
          >
            Start a conversation
          </Button>
        </div>
        <ul className="mt-10 space-y-2 text-sm">
          {site.navigation.map((item) => (
            <li key={item.href}>
              <Link
                href={item.href}
                className="underline-offset-4 hover:underline"
              >
                {item.label}
              </Link>
            </li>
          ))}
        </ul>
        {email ? (
          <p className="mt-8 text-sm text-muted-foreground">
            Or email{" "}
            <a href={enquiryMailto()} className="underline underline-offset-2">
              {email}
            </a>
            .
          </p>
        ) : null}
      </Container>
    </main>
  );
}
