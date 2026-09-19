"use client";

import { useEffect, useId, useRef, useState } from "react";
import Link from "next/link";
import { usePathname } from "next/navigation";
import { AnimatePresence, motion } from "motion/react";
import { Menu, X } from "lucide-react";
import { Button } from "@/components/ui/button";
import { usePrefersReducedMotion } from "@/components/motion/use-prefers-reduced-motion";
import { site } from "@/data/site";
import { motionTokens } from "@/lib/motion";
import { cn } from "@/lib/utils";

export function MobileNavigation() {
  const [open, setOpen] = useState(false);
  const pathname = usePathname();
  const panelId = useId();
  const buttonRef = useRef<HTMLButtonElement>(null);
  const panelRef = useRef<HTMLDivElement>(null);
  const reduced = usePrefersReducedMotion();

  useEffect(() => {
    if (!open) {
      return;
    }

    const previousOverflow = document.body.style.overflow;
    document.body.style.overflow = "hidden";

    const focusable = panelRef.current?.querySelectorAll<HTMLElement>(
      "a[href], button:not([disabled])",
    );
    focusable?.[0]?.focus();

    function onKeyDown(event: KeyboardEvent) {
      if (event.key === "Escape") {
        setOpen(false);
        buttonRef.current?.focus();
        return;
      }

      if (event.key !== "Tab" || !focusable || focusable.length === 0) {
        return;
      }

      const first = focusable[0];
      const last = focusable[focusable.length - 1];

      if (event.shiftKey && document.activeElement === first) {
        event.preventDefault();
        last.focus();
      } else if (!event.shiftKey && document.activeElement === last) {
        event.preventDefault();
        first.focus();
      }
    }

    document.addEventListener("keydown", onKeyDown);

    return () => {
      document.body.style.overflow = previousOverflow;
      document.removeEventListener("keydown", onKeyDown);
    };
  }, [open]);

  function closeAndReturn() {
    setOpen(false);
    buttonRef.current?.focus();
  }

  return (
    <div className="lg:hidden">
      <button
        ref={buttonRef}
        type="button"
        className="inline-flex size-11 items-center justify-center rounded-control"
        aria-expanded={open}
        aria-controls={panelId}
        data-testid="mobile-menu-button"
        onClick={() => setOpen((current) => !current)}
      >
        {open ? (
          <X aria-hidden="true" className="size-5" />
        ) : (
          <Menu aria-hidden="true" className="size-5" />
        )}
        <span className="sr-only">{open ? "Close menu" : "Open menu"}</span>
      </button>

      <AnimatePresence>
        {open ? (
          <motion.div
            className="fixed inset-x-0 top-[4.5rem] bottom-0 z-40"
            initial={reduced ? false : { opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={reduced ? undefined : { opacity: 0 }}
            transition={{ duration: reduced ? 0 : 0.22 }}
          >
            <button
              type="button"
              className="absolute inset-0 bg-foreground/30"
              tabIndex={-1}
              aria-hidden="true"
              onClick={closeAndReturn}
            />
            <motion.div
              ref={panelRef}
              id={panelId}
              role="dialog"
              aria-modal="true"
              aria-label="Primary"
              data-testid="mobile-menu"
              className="relative max-h-[calc(100dvh-4.5rem)] origin-top overflow-y-auto border-b border-border bg-background px-5 py-6 sm:px-6"
              initial={reduced ? false : { y: -32, opacity: 0 }}
              animate={{ y: 0, opacity: 1 }}
              exit={reduced ? undefined : { y: -16, opacity: 0 }}
              transition={{
                duration: reduced ? 0 : 0.38,
                ease: motionTokens.ease.out,
              }}
            >
              <nav>
                <ul className="space-y-1">
                  {site.navigation.map((item, index) => (
                    <motion.li
                      key={item.href}
                      initial={reduced ? false : { opacity: 0, y: 20 }}
                      animate={{ opacity: 1, y: 0 }}
                      transition={{
                        delay: reduced
                          ? 0
                          : 0.08 + index * motionTokens.stagger.tight,
                        duration: reduced ? 0 : 0.4,
                        ease: motionTokens.ease.out,
                      }}
                    >
                      <Link
                        href={item.href}
                        aria-current={
                          pathname === item.href ? "page" : undefined
                        }
                        className={cn(
                          "block py-3 text-lg tracking-tight",
                          pathname === item.href && "text-primary",
                        )}
                        onClick={() => setOpen(false)}
                      >
                        {item.label}
                      </Link>
                    </motion.li>
                  ))}
                </ul>
              </nav>
              <div className="mt-6">
                <Button
                  href={site.cta.href}
                  className="w-full"
                  data-cta="mobile-menu"
                  onClick={() => setOpen(false)}
                >
                  {site.cta.label}
                </Button>
              </div>
            </motion.div>
          </motion.div>
        ) : null}
      </AnimatePresence>
    </div>
  );
}
