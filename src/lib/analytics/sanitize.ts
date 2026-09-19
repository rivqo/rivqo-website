const blockedKeys = new Set([
  "name",
  "email",
  "company",
  "message",
  "text",
  "value",
]);

export function sanitizeAnalyticsProperties(
  properties?: Record<string, string | number | undefined>,
): Record<string, string | number> | undefined {
  if (!properties) {
    return undefined;
  }

  const safe: Record<string, string | number> = {};

  for (const [key, value] of Object.entries(properties)) {
    if (blockedKeys.has(key) || value === undefined) {
      continue;
    }

    if (typeof value === "string" && value.length > 80) {
      continue;
    }

    safe[key] = value;
  }

  return safe;
}
