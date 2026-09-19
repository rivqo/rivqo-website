"use client";

import Image from "next/image";
import Link from "next/link";
import { motion } from "motion/react";
import { Button } from "@/components/ui/button";
import { Container } from "@/components/layout/container";
import { HeaderShell } from "@/components/layout/header-shell";
import { MobileNavigation } from "@/components/layout/mobile-navigation";
import { usePathname } from "next/navigation";
import { Entrance } from "@/components/motion/entrance";
import { usePrefersReducedMotion } from "@/components/motion/use-prefers-reduced-motion";
import { site } from "@/data/site";
import { getConfirmedImage } from "@/lib/images";
import { cn } from "@/lib/utils";

export function SiteHeader() {
  const pathname = usePathname();
  const reduced = usePrefersReducedMotion();
  const logo = getConfirmedImage("brand-logo");

  return (
    <HeaderShell>
      <Container className="flex h-[4.5rem] items-center justify-between gap-4">
        <Entrance delay={0.04} y={16} scale={0.98} className="flex shrink-0">
          <Link
            href="/"
            className="header-logo shrink-0"
            aria-label={`${site.name} home`}
          >
            {logo ? (
              <Image
                src={logo.src}
                alt=""
                width={logo.width}
                height={logo.height}
                className="h-11 w-auto"
                quality={75}
                priority
              />
            ) : null}
          </Link>
        </Entrance>

        <nav aria-label="Primary" className="hidden items-center gap-1 lg:flex">
          {site.navigation.map((item, index) => {
            const current = pathname === item.href;

            return (
              <Entrance
                key={item.href}
                delay={0.1 + index * 0.05}
                y={14}
                className="flex"
              >
                <Link
                  href={item.href}
                  aria-current={current ? "page" : undefined}
                  className={cn(
                    "relative px-2.5 py-2 text-sm tracking-tight text-muted-foreground transition-colors hover:text-foreground",
                    current && "text-foreground",
                  )}
                >
                  {item.label}
                  {current && !reduced ? (
                    <motion.span
                      layoutId="nav-indicator"
                      className="absolute right-2 bottom-1 left-2 h-px bg-primary"
                      transition={{
                        type: "spring",
                        stiffness: 260,
                        damping: 30,
                      }}
                    />
                  ) : null}
                  {current && reduced ? (
                    <span
                      aria-hidden="true"
                      className="absolute right-2 bottom-1 left-2 h-px bg-primary"
                    />
                  ) : null}
                </Link>
              </Entrance>
            );
          })}
        </nav>

        <div className="hidden lg:block">
          <Entrance delay={0.36} y={16}>
            <Button href={site.cta.href} data-cta="header">
              {site.cta.label}
            </Button>
          </Entrance>
        </div>

        <MobileNavigation />
      </Container>
    </HeaderShell>
  );
}
