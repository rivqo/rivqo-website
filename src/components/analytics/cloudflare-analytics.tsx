import Script from "next/script";
import { shouldLoadCloudflareAnalytics } from "@/lib/analytics/config";

export function CloudflareAnalytics() {
  const token = process.env.NEXT_PUBLIC_CLOUDFLARE_WEB_ANALYTICS_TOKEN?.trim();

  if (!shouldLoadCloudflareAnalytics() || !token) {
    return null;
  }

  return (
    <Script
      src="https://static.cloudflareinsights.com/beacon.min.js"
      strategy="afterInteractive"
      data-cf-beacon={JSON.stringify({ token, spa: true })}
    />
  );
}
