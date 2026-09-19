import type { Metadata } from "next";
import Script from "next/script";
import { Geist, Geist_Mono } from "next/font/google";
import { BackToTop } from "@/components/layout/back-to-top";
import { SiteFooter } from "@/components/layout/site-footer";
import { SiteHeader } from "@/components/layout/site-header";
import { AnalyticsProvider } from "@/components/analytics/analytics-provider";
import { CloudflareAnalytics } from "@/components/analytics/cloudflare-analytics";
import { MotionProvider } from "@/components/motion/motion-provider";
import { ScrollProgress } from "@/components/motion/scroll-progress";
import { SmoothScroll } from "@/components/motion/smooth-scroll";
import { JsonLd, organizationJsonLd, websiteJsonLd } from "@/lib/json-ld";
import { entranceScript } from "@/lib/motion";
import { site } from "@/data/site";
import "./globals.css";

const geistSans = Geist({
  subsets: ["latin"],
  variable: "--font-geist-sans",
  display: "swap",
});

const geistMono = Geist_Mono({
  subsets: ["latin"],
  variable: "--font-geist-mono",
  display: "swap",
});

export const metadata: Metadata = {
  metadataBase: new URL(site.url),
  title: {
    default: `${site.name} — Operational Control for Project-Based Companies`,
    template: `%s · ${site.name}`,
  },
  description: site.positioning,
  applicationName: site.name,
  alternates: {
    canonical: "/",
  },
  robots: {
    index: true,
    follow: true,
  },
  openGraph: {
    type: "website",
    locale: "en",
    url: "/",
    siteName: site.name,
    title: `${site.name} — Operational Control for Project-Based Companies`,
    description: site.positioning,
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
    title: `${site.name} — Operational Control for Project-Based Companies`,
    description: site.positioning,
    images: [
      {
        url: "/twitter-image",
        width: 1200,
        height: 630,
        alt: "Rivqo — Better systems for complex operations.",
      },
    ],
  },
  icons: {
    icon: [
      { url: "/favicon.ico" },
      { url: "/brand/mark.png", type: "image/png" },
    ],
  },
};

export default function RootLayout({ children }: LayoutProps<"/">) {
  return (
    <html
      lang="en"
      className={`${geistSans.variable} ${geistMono.variable}`}
      data-scroll-behavior="smooth"
      suppressHydrationWarning
    >
      <body>
        <Script
          id="rivqo-entrance"
          strategy="beforeInteractive"
          dangerouslySetInnerHTML={{ __html: entranceScript }}
        />
        <JsonLd data={organizationJsonLd()} />
        <JsonLd data={websiteJsonLd()} />
        <CloudflareAnalytics />
        <MotionProvider>
          <AnalyticsProvider>
            <SmoothScroll>
              <a href="#main-content" className="skip-link">
                Skip to content
              </a>
              <ScrollProgress />
              <SiteHeader />
              {children}
              <SiteFooter />
              <BackToTop />
            </SmoothScroll>
          </AnalyticsProvider>
        </MotionProvider>
      </body>
    </html>
  );
}
