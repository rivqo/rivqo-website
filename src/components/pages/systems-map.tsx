"use client";

import Link from "next/link";
import { useId, useState } from "react";
import { systemsMap } from "@/data/solutions";
import { cn } from "@/lib/utils";

type SystemId = (typeof systemsMap.systems)[number]["id"];

export function SystemsMap() {
  const labelId = useId();
  const [active, setActive] = useState<SystemId>("project");
  const current =
    systemsMap.systems.find((system) => system.id === active) ??
    systemsMap.systems[0];

  function activate(id: SystemId) {
    setActive(id);
  }

  function onKeyDown(
    event: React.KeyboardEvent<HTMLButtonElement>,
    index: number,
  ) {
    const last = systemsMap.systems.length - 1;
    let next = index;

    if (event.key === "ArrowDown" || event.key === "ArrowRight") {
      next = index === last ? 0 : index + 1;
    } else if (event.key === "ArrowUp" || event.key === "ArrowLeft") {
      next = index === 0 ? last : index - 1;
    } else if (event.key === "Home") {
      next = 0;
    } else if (event.key === "End") {
      next = last;
    } else {
      return;
    }

    event.preventDefault();
    const target = systemsMap.systems[next];
    activate(target.id);
    document.getElementById(`system-${target.id}`)?.focus();
  }

  return (
    <section
      aria-labelledby="systems-map-heading"
      className="section-space border-t border-border"
    >
      <h2 id="systems-map-heading">{systemsMap.heading}</h2>
      <p className="mt-4 max-w-2xl text-muted-foreground">
        {systemsMap.introduction}
      </p>

      <div className="systems-map mt-10">
        <div className="systems-hub" aria-hidden="true">
          <p className="font-mono text-label text-primary">Connecting layer</p>
          <p className="mt-2 text-lg font-medium tracking-tight">Rivqo</p>
          <p className="mt-3 text-sm text-muted-foreground">{systemsMap.hub}</p>
        </div>

        <div role="group" aria-labelledby={labelId} className="systems-nodes">
          <p id={labelId} className="sr-only">
            Operational systems. Arrow keys move between systems.
          </p>
          {systemsMap.systems.map((system, index) => {
            const state =
              system.id === active
                ? "active"
                : (current.related as readonly string[]).includes(system.id)
                  ? "related"
                  : "idle";

            return (
              <button
                key={system.id}
                id={`system-${system.id}`}
                type="button"
                aria-pressed={system.id === active}
                data-state={state}
                className="systems-node"
                onMouseEnter={() => activate(system.id)}
                onFocus={() => activate(system.id)}
                onClick={() => activate(system.id)}
                onKeyDown={(event) => onKeyDown(event, index)}
              >
                <span className="font-mono text-label text-muted-foreground">
                  {String(index + 1).padStart(2, "0")}
                </span>
                <span className="mt-1 block text-left text-sm font-medium tracking-tight">
                  {system.label}
                </span>
              </button>
            );
          })}
        </div>

        <div className="systems-readout">
          <p className="font-mono text-label text-muted-foreground">
            Selected system
          </p>
          <p className="mt-2 text-lg font-medium tracking-tight">
            {current.label}
          </p>
          <p className="mt-3 text-sm text-muted-foreground">
            {current.outcome}
          </p>
          <p className="mt-4 font-mono text-label text-muted-foreground">
            Also active
          </p>
          <ul className="mt-2 flex flex-wrap gap-2">
            {current.related.map((id) => {
              const related = systemsMap.systems.find(
                (system) => system.id === id,
              );
              return related ? (
                <li key={id} className="systems-chip">
                  {related.label}
                </li>
              ) : null;
            })}
          </ul>
          <Link
            href={current.href}
            className={cn(
              "mt-6 inline-flex text-sm font-medium text-primary underline-offset-4 hover:underline",
            )}
          >
            Read this workflow
          </Link>
        </div>
      </div>
    </section>
  );
}
