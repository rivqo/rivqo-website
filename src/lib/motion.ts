export const motionTokens = {
  duration: {
    instant: 0,
    fast: 0.28,
    base: 0.46,
    slow: 0.64,
    entrance: 0.56,
    shortEntrance: 0.32,
  },
  stagger: {
    tight: 0.04,
    base: 0.07,
    line: 0.05,
    section: 0.08,
  },
  ease: {
    out: [0.16, 1, 0.3, 1] as const,
    inOut: [0.77, 0, 0.18, 1] as const,
    soft: [0.22, 1, 0.36, 1] as const,
  },
  spring: {
    progress: { stiffness: 68, damping: 22, mass: 0.85 },
    snappy: { stiffness: 260, damping: 30, mass: 0.7 },
    gentle: { stiffness: 120, damping: 20, mass: 0.9 },
  },
  reveal: {
    heading: 40,
    body: 22,
    board: 28,
    directional: 36,
  },
  scale: {
    enter: 0.965,
    hover: 1.012,
    logoScrolled: 0.93,
    stageActive: 1.18,
  },
  blur: {
    copy: 5,
    panel: 4,
  },
  hover: {
    lift: 6,
    icon: 8,
  },
} as const;

export const entranceScript = `
try {
  if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
    var seen = sessionStorage.getItem("rivqo-entrance") === "1";
    document.documentElement.dataset.entrance = seen ? "short" : "full";
  }
} catch (e) {}
`;

export function markEntranceSeen() {
  try {
    sessionStorage.setItem("rivqo-entrance", "1");
    document.documentElement.dataset.entrance = "done";
  } catch {
    document.documentElement.dataset.entrance = "done";
  }
}

export type EntranceMode = "full" | "short" | "none" | "done";

export function readEntranceMode(): EntranceMode {
  if (typeof document === "undefined") {
    return "none";
  }

  const value = document.documentElement.dataset.entrance;
  if (value === "full" || value === "short" || value === "done") {
    return value;
  }

  return "none";
}
