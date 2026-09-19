import type { Metadata } from "next";
import { Container } from "@/components/layout/container";
import { site } from "@/data/site";

export const metadata: Metadata = {
  title: {
    absolute: "Privacy Notice — Rivqo",
  },
  description: `How ${site.legalName} handles contact and optional website analytics information.`,
  alternates: {
    canonical: "/privacy",
  },
  robots: {
    index: true,
    follow: true,
  },
  openGraph: {
    title: `Privacy Notice — ${site.name}`,
    description: `How ${site.legalName} handles contact and optional website analytics information.`,
    url: "/privacy",
    images: [
      {
        url: "/opengraph-image",
        width: 1200,
        height: 630,
        alt: "Rivqo — Better systems for complex operations.",
      },
    ],
  },
  twitter: {
    card: "summary_large_image",
    title: `Privacy Notice — ${site.name}`,
    description: `How ${site.legalName} handles contact and optional website analytics information.`,
    images: ["/twitter-image"],
  },
};

export default function PrivacyPage() {
  const email = site.contact.email;

  return (
    <main id="main-content" className="section-space">
      <Container width="narrow">
        <p className="font-mono text-label text-primary">Privacy</p>
        <h1 className="mt-3">Privacy Notice — {site.name}</h1>
        <p className="mt-5 text-lede text-muted-foreground">
          This notice explains how {site.legalName} uses a small amount of
          information when you visit rivqo.com or write to us. It is written in
          plain language and should be reviewed by qualified Nigerian legal or
          privacy counsel before it is relied on for more sensitive processing.
        </p>

        <section className="mt-12 space-y-4">
          <h2>Information you send us</h2>
          <p>
            The public contact route is email to {email}. If you write to that
            address, we receive whatever you include in the message so we can
            review whether Rivqo can help and reply to you.
          </p>
          <p>
            The website includes an enquiry form for a later delivery
            connection. That form is not sending messages at launch. We do not
            collect or store form submissions until delivery is connected and
            this notice is updated.
          </p>
        </section>

        <section className="mt-10 space-y-4">
          <h2>Website analytics</h2>
          <p>
            Analytics is off unless a Cloudflare Web Analytics token is set in
            the production environment. Cloudflare Web Analytics is a
            cookie-free, privacy-oriented measurement of page views. It does not
            use advertising pixels, session replay, heatmaps or fingerprinting,
            and it is not loaded when the token is missing or when the site is
            not running in production.
          </p>
          <p>
            PostHog remains in the codebase for a possible later event-based
            setup. It is not part of the launch configuration. It does not load
            unless `NEXT_PUBLIC_POSTHOG_ENABLED` is true, its keys are set,
            Cloudflare analytics is unused, and the site is in production.
            Session replay and automatic form-field capture stay switched off in
            that code.
          </p>
        </section>

        <section className="mt-10 space-y-4">
          <h2>Why we process it</h2>
          <p>
            We process email you send so we can respond to a request you made.
            If analytics is enabled, it helps us understand which pages are
            reached so we can keep the site clear.
          </p>
        </section>

        <section className="mt-10 space-y-4">
          <h2>Who receives it</h2>
          <p>
            Email you send is received in the Rivqo inbox. If Cloudflare Web
            Analytics is enabled, Cloudflare processes page-view measurement for{" "}
            {site.legalName}. {site.legalName} does not sell personal
            information.
          </p>
        </section>

        <section className="mt-10 space-y-4">
          <h2>How long we keep it</h2>
          <p>
            We keep email correspondence only as long as we need it to complete
            the conversation and keep ordinary business records. We have not set
            a fixed statutory period here.
          </p>
        </section>

        <section className="mt-10 space-y-4">
          <h2>Security</h2>
          <p>
            We take reasonable steps to protect information in transit and at
            rest. No website can promise that information will never be accessed
            without authorisation.
          </p>
        </section>

        <section className="mt-10 space-y-4">
          <h2>Your requests</h2>
          <p>
            You can ask for access to the information we hold about a
            conversation, ask us to correct it, or ask us to delete it.
            {email ? (
              <>
                {" "}
                Write to{" "}
                <a
                  href={`mailto:${email}`}
                  className="underline underline-offset-2"
                >
                  {email}
                </a>
                .
              </>
            ) : null}
          </p>
        </section>

        <section className="mt-10 space-y-4">
          <h2>Updates</h2>
          <p>
            We may update this notice when the site or our providers change. The
            current version will always be published at /privacy.
          </p>
        </section>
      </Container>
    </main>
  );
}
