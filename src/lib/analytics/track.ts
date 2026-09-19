import { sanitizeAnalyticsProperties } from "@/lib/analytics/sanitize";

export function track(
  event: string,
  properties?: Record<string, string | number | undefined>,
) {
  if (typeof window === "undefined") {
    return;
  }

  const posthog = window.posthog;
  if (!posthog?.capture) {
    return;
  }

  posthog.capture(event, sanitizeAnalyticsProperties(properties));
}

declare global {
  interface Window {
    posthog?: {
      capture: (event: string, properties?: Record<string, unknown>) => void;
    };
  }
}
