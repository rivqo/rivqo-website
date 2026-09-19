"use client";

import { useLenis } from "lenis/react";
import { ArrowUp } from "lucide-react";
import { useEffect, useState } from "react";
import { usePrefersReducedMotion } from "@/components/motion/use-prefers-reduced-motion";

const SHOW_AFTER = 480;

export function BackToTop() {
  const [visible, setVisible] = useState(false);
  const reduced = usePrefersReducedMotion();
  const lenis = useLenis();

  useEffect(() => {
    function sync() {
      setVisible(window.scrollY > SHOW_AFTER);
    }

    sync();
    window.addEventListener("scroll", sync, { passive: true });
    return () => window.removeEventListener("scroll", sync);
  }, []);

  return (
    <button
      type="button"
      className="back-to-top"
      hidden={!visible}
      aria-label="Back to top"
      onClick={() => {
        if (lenis) {
          lenis.scrollTo(0, { immediate: reduced, force: true });
          return;
        }

        window.scrollTo({
          top: 0,
          left: 0,
          behavior: reduced ? "instant" : "smooth",
        });
      }}
    >
      <ArrowUp aria-hidden="true" strokeWidth={1.75} className="size-4" />
      <span className="font-mono text-label">Top</span>
    </button>
  );
}
