import { expect, test } from "@playwright/test";

test.describe("homepage interactions", () => {
  test("mobile menu opens, manages focus, and closes with Escape", async ({
    page,
  }) => {
    await page.setViewportSize({ width: 390, height: 844 });
    await page.goto("/");

    const openButton = page.getByRole("button", { name: "Open menu" });
    await openButton.click();

    const dialog = page.getByRole("dialog", { name: "Primary" });
    await expect(dialog).toBeVisible();
    await expect(dialog.getByRole("link", { name: "Solutions" })).toBeFocused();
    await expect
      .poll(() => page.evaluate(() => document.body.style.overflow))
      .toBe("hidden");

    await page.keyboard.press("Escape");
    await expect(dialog).toHaveCount(0);
    await expect(openButton).toBeFocused();
    await expect
      .poll(() => page.evaluate(() => document.body.style.overflow))
      .not.toBe("hidden");
  });

  test("role tabs respond to arrow, Home and End keys", async ({ page }) => {
    await page.setViewportSize({ width: 1440, height: 900 });
    await page.goto("/");
    await page.getByRole("tab", { name: "Executive" }).focus();

    await page.keyboard.press("ArrowRight");
    await expect(page.getByRole("tab", { name: "Operations" })).toHaveAttribute(
      "aria-selected",
      "true",
    );
    await expect(page.getByRole("tabpanel")).toContainText(
      "What is blocked, and who owns the next action?",
    );

    await page.keyboard.press("End");
    await expect(
      page.getByRole("tab", { name: "IT and Systems" }),
    ).toHaveAttribute("aria-selected", "true");

    await page.keyboard.press("Home");
    await expect(page.getByRole("tab", { name: "Executive" })).toHaveAttribute(
      "aria-selected",
      "true",
    );
  });

  test("homepage final CTA points to contact without a form", async ({
    page,
  }) => {
    await page.goto("/#start");

    await expect(page.locator("form")).toHaveCount(0);
    await expect(page.locator("#enquiry-form")).toHaveCount(0);
    await expect(
      page
        .locator("#start")
        .getByRole("link", { name: "Start a conversation" }),
    ).toHaveAttribute("href", "/contact");
  });

  test("major anchor targets exist", async ({ page }) => {
    await page.goto("/");

    for (const id of [
      "main-content",
      "problems",
      "roles",
      "capabilities",
      "method",
      "industries",
      "about",
      "start",
    ]) {
      await expect(page.locator(`#${id}`)).toHaveCount(1);
    }
  });

  test("page does not overflow horizontally at 390px", async ({ page }) => {
    await page.setViewportSize({ width: 390, height: 844 });
    await page.goto("/");

    const overflowed = await page.evaluate(() => {
      return (
        document.documentElement.scrollWidth >
        document.documentElement.clientWidth + 1
      );
    });

    expect(overflowed).toBeFalsy();
  });

  test("reduced motion settles operational compositions", async ({ page }) => {
    await page.emulateMedia({ reducedMotion: "reduce" });
    await page.goto("/");

    await expect(
      page.locator('[data-motion="operational-flow"]'),
    ).toHaveAttribute("data-motion-state", "settled");
    await expect(page.getByText("Purchase request")).toBeVisible();
    await expect(
      page.locator('[data-motion="connected-view"]'),
    ).toHaveAttribute("data-motion-state", "settled");
    await expect(page.getByText("Controlled workflow")).toBeVisible();
  });

  test("major headings follow a coherent order", async ({ page }) => {
    await page.emulateMedia({ reducedMotion: "reduce" });
    await page.goto("/");

    const headings = page.locator("h1, h2");
    await expect(headings).toHaveCount(9);
    await expect(headings.nth(0)).toHaveText(
      /Run complex projects\s*without chasing people\s*for answers\./,
    );
    await expect(headings.nth(1)).toHaveText(
      /Your projects are moving\.\s*Your information is not\./,
    );
    await expect(headings.nth(8)).toHaveText(
      /Find the workflow\s*costing your company\s*the most\./,
    );
  });

  test("conversion language stays consistent", async ({ page }) => {
    await page.emulateMedia({ reducedMotion: "reduce" });
    await page.goto("/");

    await expect(
      page.getByRole("link", { name: "Start a conversation" }),
    ).toHaveCount(5);
    await expect(
      page.getByRole("link", { name: "See how Rivqo works" }),
    ).toHaveCount(1);
    await expect(page.getByText("Book a call")).toHaveCount(0);
    await expect(page.getByText("Request a demo")).toHaveCount(0);
    await expect(page.getByText("Contact us")).toHaveCount(0);
  });

  test("page does not overflow at 768px or 1024px", async ({ page }) => {
    for (const width of [768, 1024, 1440, 1728]) {
      await page.setViewportSize({ width, height: 900 });
      await page.goto("/");

      const overflowed = await page.evaluate(() => {
        return (
          document.documentElement.scrollWidth >
          document.documentElement.clientWidth + 1
        );
      });

      expect(overflowed, `${width}px`).toBeFalsy();
    }
  });

  test("sticky operational scenes settle after scrolling through them", async ({
    page,
  }) => {
    await page.setViewportSize({ width: 1440, height: 900 });
    await page.goto("/");

    await page.evaluate(() => {
      const story = document.querySelector(".hero-story");
      if (!story) {
        return;
      }

      const end =
        story.getBoundingClientRect().top +
        window.scrollY +
        story.getBoundingClientRect().height;
      window.scrollTo({ top: end, left: 0, behavior: "instant" });
    });

    await expect
      .poll(() =>
        page
          .locator('[data-motion="operational-flow"]')
          .getAttribute("data-motion-state"),
      )
      .toBe("settled");

    await page.evaluate(() => {
      const story = document.querySelector(".connected-story");
      if (!story) {
        return;
      }

      const end =
        story.getBoundingClientRect().top +
        window.scrollY +
        story.getBoundingClientRect().height;
      window.scrollTo({ top: end, left: 0, behavior: "instant" });
    });

    await expect
      .poll(() =>
        page
          .locator('[data-motion="connected-view"]')
          .getAttribute("data-motion-state"),
      )
      .toBe("settled");
  });

  test("skip link is the first focusable control", async ({ page }) => {
    await page.goto("/");
    await page.keyboard.press("Tab");
    await expect(
      page.getByRole("link", { name: "Skip to content" }),
    ).toBeFocused();
  });
});
