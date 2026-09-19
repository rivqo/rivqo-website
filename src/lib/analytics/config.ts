export function cloudflareAnalyticsToken() {
  return process.env.NEXT_PUBLIC_CLOUDFLARE_WEB_ANALYTICS_TOKEN?.trim() ?? "";
}

export function shouldLoadCloudflareAnalytics() {
  return (
    process.env.NODE_ENV === "production" && Boolean(cloudflareAnalyticsToken())
  );
}

export function analyticsConfigured() {
  return Boolean(
    process.env.NEXT_PUBLIC_POSTHOG_KEY && process.env.NEXT_PUBLIC_POSTHOG_HOST,
  );
}

export function shouldLoadPosthog() {
  return (
    process.env.NODE_ENV === "production" &&
    process.env.NEXT_PUBLIC_POSTHOG_ENABLED === "true" &&
    !shouldLoadCloudflareAnalytics() &&
    analyticsConfigured()
  );
}

export function respectDoNotTrack() {
  if (typeof navigator === "undefined") {
    return false;
  }

  return navigator.doNotTrack === "1";
}
