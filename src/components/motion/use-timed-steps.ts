"use client";

import { useEffect, useState } from "react";

export function useTimedSteps(
  enabled: boolean,
  instant: boolean,
  delays: readonly number[],
) {
  const settled = delays.length;
  const [elapsedStep, setElapsedStep] = useState(0);

  useEffect(() => {
    if (instant || !enabled) {
      return;
    }

    const timers = delays.map((delay, index) =>
      setTimeout(() => setElapsedStep(index + 1), delay),
    );

    return () => {
      timers.forEach(clearTimeout);
    };
  }, [delays, enabled, instant]);

  if (instant) {
    return settled;
  }

  if (!enabled) {
    return -1;
  }

  return elapsedStep;
}
