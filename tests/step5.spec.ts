import { expect, test } from "@playwright/test";

test.describe("contact, privacy and enquiry delivery", () => {
  test("footer shows the public email and privacy link", async ({ page }) => {
    await page.goto("/");

    const email = page.getByRole("contentinfo").getByRole("link", {
      name: "ola@rivqo.com",
    });
    await expect(email).toBeVisible();
    await expect(email).toHaveAttribute("href", "mailto:ola@rivqo.com");
    await expect(
      page
        .getByRole("contentinfo")
        .getByRole("link", { name: "Privacy Notice" }),
    ).toHaveAttribute("href", "/privacy");
  });

  test("privacy page renders the confirmed business details", async ({
    page,
  }) => {
    await page.goto("/privacy");

    await expect(
      page.getByRole("heading", { name: "Privacy Notice — Rivqo" }),
    ).toBeVisible();
    await expect(page.getByText("Rivqo Digital LTD").first()).toBeVisible();
    await expect(
      page
        .locator("#main-content")
        .getByRole("link", { name: "ola@rivqo.com" }),
    ).toHaveAttribute("href", "mailto:ola@rivqo.com");
  });

  test("homepage no longer presents an enquiry form", async ({ page }) => {
    await page.goto("/");
    await expect(page.locator("#enquiry-form")).toHaveCount(0);
    await expect(page.locator("form")).toHaveCount(0);
  });

  test("analytics is silent when analytics variables are absent", async ({
    page,
  }) => {
    const analyticsRequests: string[] = [];
    page.on("request", (request) => {
      if (/posthog|i\.posthog|cloudflareinsights/i.test(request.url())) {
        analyticsRequests.push(request.url());
      }
    });

    await page.goto("/");
    await page.waitForTimeout(500);
    expect(analyticsRequests).toEqual([]);
  });

  test("unknown routes render a useful 404", async ({ page }) => {
    const response = await page.goto("/this-page-does-not-exist");
    expect(response?.status()).toBe(404);
    await expect(
      page.getByRole("heading", { name: "This page is not available." }),
    ).toBeVisible();
    await expect(
      page.locator("#main-content").getByRole("link", { name: "Rivqo home" }),
    ).toHaveAttribute("href", "/");
    await expect(
      page.locator("#main-content").getByRole("link", { name: "ola@rivqo.com" }),
    ).toBeVisible();
    await expect(page.getByText("Book a call")).toHaveCount(0);
  });

  test("production security headers are present", async ({ request }) => {
    const response = await request.get("/");
    const headers = response.headers();
    expect(headers["content-security-policy"]).toContain("default-src 'self'");
    expect(headers["content-security-policy"]).toContain(
      "https://static.cloudflareinsights.com",
    );
    expect(headers["referrer-policy"]).toBe("strict-origin-when-cross-origin");
    expect(headers["x-content-type-options"]).toBe("nosniff");
    expect(headers["x-frame-options"]).toBe("DENY");
    expect(headers["permissions-policy"]).toContain("camera=()");
  });

  test("robots.txt points at the production sitemap", async ({ request }) => {
    const response = await request.get("/robots.txt");
    expect(response.ok()).toBeTruthy();
    const body = await response.text();
    expect(body).toContain("Allow: /");
    expect(body).toContain("https://rivqo.com/sitemap.xml");
  });

  test("open graph image route returns an image", async ({ request }) => {
    const response = await request.get("/opengraph-image");
    expect(response.ok()).toBeTruthy();
    expect(response.headers()["content-type"]).toMatch(/image\//);
  });

  test("twitter image route returns an image", async ({ request }) => {
    const response = await request.get("/twitter-image");
    expect(response.ok()).toBeTruthy();
    expect(response.headers()["content-type"]).toMatch(/image\//);
  });
});
