"use client";

import { useEffect, useState } from "react";
import { cn } from "@/lib/utils";

export function HeaderShell({ children }: { children: React.ReactNode }) {
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    function onScroll() {
      setScrolled(window.scrollY > 12);
    }

    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  return (
    <header
      data-scrolled={scrolled}
      style={{ viewTransitionName: "site-header" }}
      className={cn(
        "sticky top-0 z-40 border-b transition-[background-color,border-color,box-shadow] duration-400",
        scrolled
          ? "border-foreground/12 bg-background shadow-[0_1px_0_rgba(26,31,29,0.06)]"
          : "border-border/70 bg-background",
      )}
    >
      {children}
    </header>
  );
}
