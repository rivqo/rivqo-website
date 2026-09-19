"use client";

import { useEffect } from "react";
import { respectDoNotTrack, shouldLoadPosthog } from "@/lib/analytics/config";
import { track } from "@/lib/analytics/track";

export function AnalyticsProvider({ children }: { children: React.ReactNode }) {
  useEffect(() => {
    const key = process.env.NEXT_PUBLIC_POSTHOG_KEY;
    const host = process.env.NEXT_PUBLIC_POSTHOG_HOST;

    if (!key || !host || respectDoNotTrack() || !shouldLoadPosthog()) {
      return;
    }

    let cancelled = false;
    let onClick: ((event: MouseEvent) => void) | undefined;

    void import("posthog-js").then(({ default: posthog }) => {
      if (cancelled) {
        return;
      }

      posthog.init(key, {
        api_host: host,
        capture_pageview: true,
        autocapture: false,
        disable_session_recording: true,
        mask_all_text: true,
        mask_all_element_attributes: true,
        persistence: "memory",
      });

      window.posthog = posthog;

      onClick = (event: MouseEvent) => {
        const target = event.target;
        if (!(target instanceof Element)) {
          return;
        }

        const cta = target.closest("[data-cta]");
        if (!(cta instanceof HTMLElement)) {
          return;
        }

        track("cta_clicked", {
          location: cta.dataset.cta ?? "unknown",
          pathname: window.location.pathname,
        });
      };

      document.addEventListener("click", onClick);
    });

    return () => {
      cancelled = true;
      if (onClick) {
        document.removeEventListener("click", onClick);
      }
    };
  }, []);

  return children;
}
