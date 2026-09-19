"use client";

import { ReactLenis, useLenis } from "lenis/react";
import { usePathname } from "next/navigation";
import { useEffect, useLayoutEffect, useRef } from "react";
import { usePrefersReducedMotion } from "@/components/motion/use-prefers-reduced-motion";

function LenisLock({ reduced }: { reduced: boolean }) {
  const lenis = useLenis();

  useEffect(() => {
    if (!lenis) {
      return;
    }

    function sync() {
      if (!lenis) {
        return;
      }

      if (
        reduced ||
        document.hidden ||
        document.body.style.overflow === "hidden"
      ) {
        lenis.stop();
      } else {
        lenis.start();
      }
    }

    sync();
    document.addEventListener("visibilitychange", sync);
    const observer = new MutationObserver(sync);
    observer.observe(document.body, {
      attributes: true,
      attributeFilter: ["style"],
    });
    return () => {
      document.removeEventListener("visibilitychange", sync);
      observer.disconnect();
    };
  }, [lenis, reduced]);

  return null;
}

function scrollToHashOrTop(lenis: ReturnType<typeof useLenis>, hash: string) {
  if (hash) {
    const id = decodeURIComponent(hash.slice(1));
    const target = document.getElementById(id);
    if (target) {
      lenis?.scrollTo(target, { immediate: true, force: true });
      target.scrollIntoView({ block: "start", behavior: "instant" });
      return;
    }
  }

  lenis?.scrollTo(0, { immediate: true, force: true });
  window.scrollTo({ top: 0, left: 0, behavior: "instant" });
}

const lenisOptions = {
  autoRaf: true,
  duration: 0.92,
  anchors: false,
  overscroll: false,
  prevent: (node: HTMLElement) =>
    Boolean(
      node.closest("dialog, [role='dialog'], form, [data-lenis-prevent]"),
    ),
  easing: (time: number) => Math.min(1, 1.001 - Math.pow(2, -10 * time)),
};

function LenisRouteReset() {
  const pathname = usePathname();
  const lenis = useLenis();
  const previousPath = useRef<string | null>(null);

  useLayoutEffect(() => {
    const hash = window.location.hash;
    const previous = previousPath.current;
    const navigated = previous !== null && previous !== pathname;
    previousPath.current = pathname;

    if (!navigated) {
      if (hash && lenis) {
        scrollToHashOrTop(lenis, hash);
      }
      return;
    }

    scrollToHashOrTop(lenis, hash);

    if (!hash) {
      return;
    }

    const frame = window.requestAnimationFrame(() => {
      scrollToHashOrTop(lenis, hash);
    });
    return () => window.cancelAnimationFrame(frame);
  }, [pathname, lenis]);

  useEffect(() => {
    function onHashChange() {
      scrollToHashOrTop(lenis, window.location.hash);
    }

    window.addEventListener("hashchange", onHashChange);
    return () => window.removeEventListener("hashchange", onHashChange);
  }, [lenis]);

  return null;
}

export function SmoothScroll({ children }: { children: React.ReactNode }) {
  const reduced = usePrefersReducedMotion();

  return (
    <ReactLenis root options={lenisOptions}>
      <LenisLock reduced={reduced} />
      <LenisRouteReset />
      {children}
    </ReactLenis>
  );
}
