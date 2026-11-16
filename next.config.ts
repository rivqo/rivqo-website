import type { NextConfig } from "next";

const isDev = process.env.NODE_ENV !== "production";

const chatwootOrigins = [
  "http://localhost:8081",
  "http://127.0.0.1:8081",
  "ws://localhost:8081",
  "ws://127.0.0.1:8081",
  "https://chat.rivqo.com",
  "wss://chat.rivqo.com",
].join(" ");

const contentSecurityPolicy = [
  "default-src 'self'",
  "base-uri 'self'",
  "form-action 'self'",
  "frame-ancestors 'none'",
  "object-src 'none'",
  `script-src 'self' 'unsafe-inline'${isDev ? " 'unsafe-eval'" : ""} https://static.cloudflareinsights.com ${chatwootOrigins}`,
  "style-src 'self' 'unsafe-inline'",
  `img-src 'self' data: blob: ${chatwootOrigins}`,
  "font-src 'self' data:",
  `connect-src 'self' https://cloudflareinsights.com https://static.cloudflareinsights.com ${chatwootOrigins}`,
  `frame-src ${chatwootOrigins}`,
  "worker-src 'self' blob:",
].join("; ");

const securityHeaders = [
  {
    key: "Content-Security-Policy",
    value: contentSecurityPolicy,
  },
  {
    key: "Referrer-Policy",
    value: "strict-origin-when-cross-origin",
  },
  {
    key: "X-Content-Type-Options",
    value: "nosniff",
  },
  {
    key: "X-Frame-Options",
    value: "DENY",
  },
  {
    key: "Permissions-Policy",
    value:
      "camera=(), microphone=(), geolocation=(), payment=(), usb=(), interest-cohort=()",
  },
  {
    key: "X-DNS-Prefetch-Control",
    value: "off",
  },
];

const nextConfig: NextConfig = {
  images: {
    formats: ["image/avif", "image/webp"],
  },
  async headers() {
    return [
      {
        source: "/:path*",
        headers: securityHeaders,
      },
    ];
  },
};

export default nextConfig;
