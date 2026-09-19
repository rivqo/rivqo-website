import { expect, test } from "@playwright/test";

const pages = [
  {
    path: "/",
    title: /Operational Control for Project-Based Companies/,
    heading: /Run complex projects/,
  },
  {
    path: "/solutions",
    title: "Solutions — Rivqo",
    heading:
      "Control the workflows that determine whether projects stay on track.",
  },
  {
    path: "/method",
    title: "How We Work — Rivqo",
    heading:
      "Start with one operational problem. Prove improvement before scaling.",
  },
  {
    path: "/industries",
    title: "Industries — Rivqo",
    heading:
      "For businesses where procurement, projects and delivery must move together.",
  },
  {
    path: "/about",
    title: "About Rivqo",
    heading: "We understand the work behind the software.",
  },
  {
    path: "/contact",
    title: "Start a Conversation — Rivqo",
    heading:
      "Tell us which workflow is creating the most delay, uncertainty or repeated work.",
  },
] as const;

test.describe("supporting pages", () => {
  for (const pageInfo of pages) {
    test(`${pageInfo.path} returns successfully with a unique title and one h1`, async ({
      page,
    }) => {
      const response = await page.goto(pageInfo.path);
      expect(response?.ok()).toBeTruthy();
      await expect(page).toHaveTitle(pageInfo.title);
      await expect(page.locator("h1")).toHaveCount(1);
      await expect(page.locator("h1")).toContainText(pageInfo.heading);
    });
  }

  test("primary navigation points to the commercial pages", async ({
    page,
  }) => {
    await page.setViewportSize({ width: 1440, height: 900 });
    await page.goto("/");

    const nav = page.getByRole("navigation", { name: "Primary" });
    await expect(nav.getByRole("link", { name: "Solutions" })).toHaveAttribute(
      "href",
      "/solutions",
    );
    await expect(nav.getByRole("link", { name: "Method" })).toHaveAttribute(
      "href",
      "/method",
    );
    await expect(nav.getByRole("link", { name: "Industries" })).toHaveAttribute(
      "href",
      "/industries",
    );
    await expect(nav.getByRole("link", { name: "About" })).toHaveAttribute(
      "href",
      "/about",
    );
    await expect(
      page
        .getByRole("banner")
        .getByRole("link", { name: "Start a conversation" }),
    ).toHaveAttribute("href", "/contact");
    await expect(
      page.getByRole("link", { name: "Rivqo home" }),
    ).toHaveAttribute("href", "/");
  });

  test("a new route starts at the top after a scrolled page", async ({
    page,
  }) => {
    await page.setViewportSize({ width: 1440, height: 900 });
    await page.goto("/solutions");
    await page.evaluate(() =>
      window.scrollTo({ top: 2400, left: 0, behavior: "instant" }),
    );
    await expect
      .poll(async () => page.evaluate(() => window.scrollY))
      .toBeGreaterThan(400);

    await page
      .getByRole("navigation", { name: "Primary" })
      .getByRole("link", { name: "Method" })
      .click();
    await expect(page).toHaveURL("/method");
    await expect(page.getByRole("heading", { level: 1 })).toBeVisible();
    await expect
      .poll(async () => page.evaluate(() => window.scrollY))
      .toBeLessThan(24);
  });

  test("back to top returns from a scrolled page", async ({ page }) => {
    await page.setViewportSize({ width: 1440, height: 900 });
    await page.goto("/industries");
    await expect(page.getByRole("button", { name: "Back to top" })).toHaveCount(
      0,
    );

    await page.evaluate(() =>
      window.scrollTo({ top: 1800, left: 0, behavior: "instant" }),
    );
    const control = page.getByRole("button", { name: "Back to top" });
    await expect(control).toBeVisible();
    await control.click();
    await expect
      .poll(async () => page.evaluate(() => window.scrollY))
      .toBeLessThan(24);
    await expect(control).toHaveCount(0);
  });

  test("current route is indicated accessibly", async ({ page }) => {
    await page.setViewportSize({ width: 1440, height: 900 });
    await page.goto("/method");

    const current = page
      .getByRole("navigation", { name: "Primary" })
      .getByRole("link", { name: "Method" });
    await expect(current).toHaveAttribute("aria-current", "page");
    await expect(
      page.getByRole("navigation", { name: "Primary" }).getByRole("link", {
        name: "Solutions",
      }),
    ).not.toHaveAttribute("aria-current", "page");
  });

  test("mobile navigation works from an interior page", async ({ page }) => {
    await page.setViewportSize({ width: 390, height: 844 });
    await page.goto("/solutions");

    await page.getByRole("button", { name: "Open menu" }).click();
    const dialog = page.getByRole("dialog", { name: "Primary" });
    await expect(
      dialog.getByRole("link", { name: "Solutions" }),
    ).toHaveAttribute("aria-current", "page");
    await dialog.getByRole("link", { name: "About" }).click();
    await expect(page).toHaveURL("/about");
    await expect(page.getByRole("heading", { level: 1 })).toContainText(
      "We understand the work behind the software.",
    );
  });

  test("page titles and descriptions are unique", async ({ page }) => {
    const seenTitles = new Set<string>();
    const seenDescriptions = new Set<string>();

    for (const pageInfo of pages) {
      await page.goto(pageInfo.path);
      const title = await page.title();
      const description = await page
        .locator('meta[name="description"]')
        .getAttribute("content");

      expect(title.length).toBeGreaterThan(8);
      expect(description?.length).toBeGreaterThan(20);
      expect(seenTitles.has(title)).toBeFalsy();
      expect(seenDescriptions.has(description ?? "")).toBeFalsy();
      seenTitles.add(title);
      seenDescriptions.add(description ?? "");
    }
  });

  test("heading hierarchy does not skip levels", async ({ page }) => {
    for (const pageInfo of pages) {
      await page.goto(pageInfo.path);
      const levels = await page
        .locator("h1, h2, h3, h4")
        .evaluateAll((nodes) =>
          nodes.map((node) => Number(node.tagName.slice(1))),
        );

      expect(levels[0], pageInfo.path).toBe(1);
      for (let index = 1; index < levels.length; index += 1) {
        expect(
          levels[index] - levels[index - 1],
          `${pageInfo.path} heading jump`,
        ).toBeLessThanOrEqual(1);
      }
    }
  });

  test("contact presents the enquiry form and an email fallback", async ({
    page,
  }) => {
    await page.goto("/contact");

    await expect(page.locator("#enquiry-form")).toBeVisible();
    await expect(page.getByLabel("Full name")).toBeVisible();
    await expect(page.getByLabel("Work email")).toBeVisible();
    await expect(
      page.getByRole("button", { name: "Start a conversation" }),
    ).toHaveCount(0);
    await expect(
      page.getByText("Thank you. Your enquiry has been sent"),
    ).toHaveCount(0);

    const email = page.getByRole("link", { name: "ola@rivqo.com" }).first();
    await expect(email).toBeVisible();
    await expect(email).toHaveAttribute("href", /mailto:ola@rivqo.com/);
    await expect(
      page.getByRole("link", { name: "Email ola@rivqo.com" }),
    ).toHaveAttribute(
      "href",
      "mailto:ola@rivqo.com?subject=Operational%20improvement%20enquiry",
    );
    await expect(page.getByText("Coming soon")).toHaveCount(0);
    await expect(page.getByText("Book a call")).toHaveCount(0);
    await expect(page.locator("[data-media]")).toHaveCount(0);
  });

  test("industries page shows five editorial plates with context captions", async ({
    page,
  }) => {
    await page.goto("/industries");
    await expect(page.locator("[data-media^='industry-']")).toHaveCount(5);
    await expect(
      page.getByText("Industry context artwork. Not a Rivqo client project."),
    ).toHaveCount(5);
    await expect(page.getByText("Sample workflow")).toHaveCount(5);
    await expect(
      page.getByRole("img", {
        name: "Electrical substation equipment against a dawn sky, typical of power EPC delivery.",
      }),
    ).toBeVisible();
    await expect(page.getByText("image coming soon")).toHaveCount(0);
  });

  test("industry plates remain readable with reduced motion", async ({
    page,
  }) => {
    await page.emulateMedia({ reducedMotion: "reduce" });
    await page.goto("/industries");
    await expect(page.locator("[data-media='industry-epc']")).toBeVisible();
    await expect(
      page.getByRole("img", {
        name: "Electrical substation equipment against a dawn sky, typical of power EPC delivery.",
      }),
    ).toBeVisible();
    const box = await page.locator("[data-media='industry-epc']").boundingBox();
    expect(box?.width).toBeGreaterThan(200);
    expect(box?.height).toBeGreaterThan(140);
  });

  test("solutions map highlights related systems from keyboard", async ({
    page,
  }) => {
    await page.setViewportSize({ width: 1440, height: 900 });
    await page.goto("/solutions");
    const procurement = page.getByRole("button", { name: /Procurement$/ });
    await procurement.focus();
    await expect(procurement).toHaveAttribute("aria-pressed", "true");
    await expect(
      page.getByText(
        "A request can be followed to vendor, commitment, delivery evidence and payment status.",
      ),
    ).toBeVisible();
    await expect(
      page.getByRole("button", { name: /Project delivery/ }),
    ).toHaveAttribute("data-state", "related");
    await procurement.press("ArrowDown");
    await expect(
      page.getByRole("button", { name: /Finance and reconciliation/ }),
    ).toHaveAttribute("aria-pressed", "true");
    await expect(page.locator("[data-media^='industry-']")).toHaveCount(0);
  });

  test("method journey shows a tangible output for each stage", async ({
    page,
  }) => {
    await page.goto("/method");
    await expect(
      page.getByRole("heading", { name: "The delivery journey" }),
    ).toBeVisible();
    await page.getByRole("button", { name: /Prioritise/ }).click();
    await expect(page.getByText("Opportunity register")).toBeVisible();
    await expect(page.getByText("Prove first")).toBeVisible();
    await page.getByRole("button", { name: /Prove/ }).focus();
    await expect(page.getByText("Prototype or pilot")).toBeVisible();
    await expect(page.locator("[data-media]")).toHaveCount(0);
  });

  test("about uses experience bands instead of portraits", async ({ page }) => {
    await page.goto("/about");
    await expect(
      page.getByRole("heading", { name: "Where the practice comes from" }),
    ).toBeVisible();
    await expect(
      page.getByRole("heading", { name: "Software engineering" }),
    ).toBeVisible();
    await expect(
      page.getByRole("heading", { name: "Operational experience" }),
    ).toBeVisible();
    await expect(
      page.getByRole("heading", { name: "Industrial delivery" }),
    ).toBeVisible();
    await expect(page.locator("[data-media]")).toHaveCount(0);
    await expect(page.getByText("image coming soon")).toHaveCount(0);
  });

  test("contact shows the engagement path and public email", async ({
    page,
  }) => {
    await page.goto("/contact");
    await expect(
      page.getByRole("heading", { name: "How a first conversation works" }),
    ).toBeVisible();
    await expect(
      page.getByRole("heading", {
        name: "Tell us what is slowing the operation",
      }),
    ).toBeVisible();
    await expect(
      page.getByText("Rivqo Digital LTD", { exact: true }),
    ).toBeVisible();
    await expect(
      page.getByRole("link", { name: "ola@rivqo.com" }).first(),
    ).toBeVisible();
    await expect(page.locator("[data-media]")).toHaveCount(0);
  });

  test("homepage industries stay typographic", async ({ page }) => {
    await page.goto("/");
    await expect(page.locator("[data-media^='industry-']")).toHaveCount(0);
  });

  test("missing photographs do not leave placeholders", async ({ page }) => {
    for (const path of ["/method", "/about"]) {
      await page.goto(path);
      await expect(page.locator("[data-media]")).toHaveCount(0);
      await expect(page.getByText("image coming soon")).toHaveCount(0);
      await expect(page.locator("img[src='']")).toHaveCount(0);
      const remotes = await page.locator("img[src^='http']").count();
      expect(remotes, path).toBe(0);
    }
  });

  test("no invented phone number or address appears", async ({ page }) => {
    for (const pageInfo of pages) {
      await page.goto(pageInfo.path);
      await expect(
        page.getByText(/\+234|telephone|office address/i),
      ).toHaveCount(0);
      await expect(page.locator("address")).toHaveCount(0);
    }
  });

  test("public routes expose unique social and canonical metadata", async ({
    page,
  }) => {
    for (const pageInfo of pages) {
      await page.goto(pageInfo.path);
      const canonical = await page
        .locator('link[rel="canonical"]')
        .getAttribute("href");
      const description = await page
        .locator('meta[name="description"]')
        .getAttribute("content");
      const ogImage = await page
        .locator('meta[property="og:image"]')
        .getAttribute("content");
      const twitterCard = await page
        .locator('meta[name="twitter:card"]')
        .getAttribute("content");

      expect(canonical, pageInfo.path).toMatch(
        pageInfo.path === "/"
          ? /^https:\/\/rivqo\.com\/?$/
          : new RegExp(`https://rivqo.com${pageInfo.path}/?$`),
      );
      expect(description?.length, pageInfo.path).toBeGreaterThan(20);
      expect(ogImage, pageInfo.path).toMatch(/opengraph-image/);
      expect(twitterCard, pageInfo.path).toBe("summary_large_image");
    }
  });

  test("sitemap lists the intended public routes", async ({ request }) => {
    const response = await request.get("/sitemap.xml");
    expect(response.ok()).toBeTruthy();
    const body = await response.text();

    for (const path of [
      "https://rivqo.com/",
      "https://rivqo.com/solutions",
      "https://rivqo.com/method",
      "https://rivqo.com/industries",
      "https://rivqo.com/about",
      "https://rivqo.com/contact",
      "https://rivqo.com/privacy",
    ]) {
      expect(body).toContain(path);
    }
  });

  test("supporting pages do not overflow at key widths", async ({ page }) => {
    for (const width of [390, 768, 1024, 1440, 1728]) {
      await page.setViewportSize({ width, height: 900 });
      for (const path of [
        "/solutions",
        "/method",
        "/industries",
        "/about",
        "/contact",
      ]) {
        await page.goto(path);
        const overflowed = await page.evaluate(() => {
          return (
            document.documentElement.scrollWidth >
            document.documentElement.clientWidth + 1
          );
        });
        expect(overflowed, `${path} at ${width}px`).toBeFalsy();
      }
    }
  });

  test("reduced motion keeps interior headings readable", async ({ page }) => {
    await page.emulateMedia({ reducedMotion: "reduce" });
    await page.goto("/solutions");
    await expect(page.locator("h1")).toBeVisible();
    await expect(
      page.getByRole("heading", { name: "Connected operating systems" }),
    ).toBeVisible();
    await expect(
      page.getByRole("button", { name: /Project delivery/ }),
    ).toHaveAttribute("aria-pressed", "true");
    await expect(
      page.getByRole("heading", { name: "Procurement and vendor control" }),
    ).toBeVisible();
    await expect(
      page.locator('[data-motion="workflow-board"]').first(),
    ).toHaveAttribute("data-motion-state", "settled");
    await expect(
      page.getByText("Purchase request", { exact: true }),
    ).toBeVisible();
  });
});
