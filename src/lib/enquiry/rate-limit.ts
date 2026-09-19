export type RateLimitDecision = {
  allowed: boolean;
};

export type RateLimiter = {
  consume: (key: string) => Promise<RateLimitDecision>;
};

type WindowEntry = {
  count: number;
  resetAt: number;
};

const WINDOW_MS = 10 * 60 * 1000;
const MAX_ATTEMPTS = 5;

const memoryStore = new Map<string, WindowEntry>();

/**
 * Best-effort in-process limiter. It is not shared across serverless
 * instances and must be replaced with platform or KV storage if abuse
 * becomes a problem.
 */
export function createMemoryRateLimiter(
  now: () => number = Date.now,
): RateLimiter {
  return {
    async consume(key) {
      const current = now();
      const existing = memoryStore.get(key);

      if (!existing || existing.resetAt <= current) {
        memoryStore.set(key, { count: 1, resetAt: current + WINDOW_MS });
        return { allowed: true };
      }

      if (existing.count >= MAX_ATTEMPTS) {
        return { allowed: false };
      }

      existing.count += 1;
      memoryStore.set(key, existing);
      return { allowed: true };
    },
  };
}

export const defaultRateLimiter = createMemoryRateLimiter();
