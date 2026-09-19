"use client";

import { useEffect } from "react";
import { track } from "@/lib/analytics/track";

export function ViewTracker({
  event,
  targetId,
}: {
  event: "method_viewed";
  targetId: string;
}) {
  useEffect(() => {
    const node = document.getElementById(targetId);
    if (!node) {
      return;
    }

    const observer = new IntersectionObserver(
      (entries) => {
        if (entries.some((entry) => entry.isIntersecting)) {
          track(event, { pathname: window.location.pathname });
          observer.disconnect();
        }
      },
      { threshold: 0.35 },
    );

    observer.observe(node);
    return () => observer.disconnect();
  }, [event, targetId]);

  return null;
}
