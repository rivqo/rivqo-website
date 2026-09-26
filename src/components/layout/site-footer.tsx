import Image from "next/image";
import Link from "next/link";
import { Container } from "@/components/layout/container";
import { Button } from "@/components/ui/button";
import { site } from "@/data/site";
import { getConfirmedImage } from "@/lib/images";

export function SiteFooter() {
  const year = new Date().getFullYear();
  const logo = getConfirmedImage("brand-logo");

  return (
    <footer
      className="border-t border-border"
      style={{ viewTransitionName: "site-footer" }}
    >
      <Container className="grid gap-10 py-12 md:grid-cols-[minmax(0,1.4fr)_minmax(0,1fr)]">
        <div>
          {logo ? (
            <Image
              src={logo.src}
              alt={logo.alt}
              width={logo.width}
              height={logo.height}
              className="h-11 w-auto"
              quality={75}
            />
          ) : null}
          <p className="mt-5 max-w-md text-muted-foreground">
            {site.positioning}
          </p>
          <p className="mt-3 font-mono text-label text-muted-foreground">
            {site.legalName}
          </p>
        </div>

        <div className="grid gap-8 sm:grid-cols-2">
          <nav aria-label="Footer">
            <p className="font-mono text-label text-muted-foreground">
              Explore
            </p>
            <ul className="mt-3 space-y-2">
              {site.navigation.map((item) => (
                <li key={item.href}>
                  <Link href={item.href} className="text-sm hover:text-primary">
                    {item.label}
                  </Link>
                </li>
              ))}
              <li>
                <Link href="/privacy" className="text-sm hover:text-primary">
                  Privacy Notice
                </Link>
              </li>
            </ul>
          </nav>

          <div>
            <p className="font-mono text-label text-muted-foreground">
              Contact
            </p>
            {site.contact.email ? (
              <p className="mt-3">
                <a
                  href={`mailto:${site.contact.email}`}
                  className="text-sm underline-offset-2 hover:text-primary hover:underline"
                >
                  {site.contact.email}
                </a>
              </p>
            ) : null}
            <div className="mt-5">
              <Button href={site.cta.href} data-cta="footer">
                {site.cta.label}
              </Button>
            </div>
          </div>
        </div>
      </Container>

      <Container className="border-t border-border py-5">
        <p className="font-mono text-label text-muted-foreground">
          © {year} {site.legalName}
        </p>
      </Container>
    </footer>
  );
}
