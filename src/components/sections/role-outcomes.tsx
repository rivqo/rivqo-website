"use client";

import { AnimatePresence, motion } from "motion/react";
import { useId, useState } from "react";
import { Container } from "@/components/layout/container";
import { InViewReveal } from "@/components/motion/in-view-reveal";
import { TextReveal } from "@/components/motion/text-reveal";
import { usePrefersReducedMotion } from "@/components/motion/use-prefers-reduced-motion";
import { StatusLabel } from "@/components/ui/status-label";
import { roles } from "@/data/homepage";
import { track } from "@/lib/analytics/track";
import { motionTokens } from "@/lib/motion";
import { cn } from "@/lib/utils";

export function RoleOutcomes() {
  const baseId = useId();
  const instant = usePrefersReducedMotion();
  const [selectedId, setSelectedId] = useState(roles[0].id);
  const [direction, setDirection] = useState(1);
  const selected = roles.find((role) => role.id === selectedId) ?? roles[0];
  const selectedIndex = roles.findIndex((role) => role.id === selected.id);

  function selectRole(nextId: string) {
    const nextIndex = roles.findIndex((role) => role.id === nextId);
    setDirection(nextIndex >= selectedIndex ? 1 : -1);
    setSelectedId(nextId);
    track("role_tab_changed", { role: nextId, pathname: "/" });
  }

  function onTabKeyDown(
    event: React.KeyboardEvent<HTMLButtonElement>,
    index: number,
  ) {
    const last = roles.length - 1;
    let next = index;

    if (event.key === "ArrowRight" || event.key === "ArrowDown") {
      next = index === last ? 0 : index + 1;
    } else if (event.key === "ArrowLeft" || event.key === "ArrowUp") {
      next = index === 0 ? last : index - 1;
    } else if (event.key === "Home") {
      next = 0;
    } else if (event.key === "End") {
      next = last;
    } else {
      return;
    }

    event.preventDefault();
    selectRole(roles[next].id);
    document.getElementById(`${baseId}-tab-${roles[next].id}`)?.focus();
  }

  return (
    <section
      id="roles"
      aria-labelledby="roles-heading"
      className="section-space border-y border-border bg-muted/50"
    >
      <Container>
        <TextReveal
          as="h2"
          id="roles-heading"
          className="max-w-2xl"
          lines={["One operation.", "Different questions."]}
        />

        <InViewReveal className="mt-10">
          <div
            role="tablist"
            aria-label="Roles"
            className="relative flex flex-wrap gap-x-1 border-b border-border"
          >
            {roles.map((role, index) => {
              const selectedTab = role.id === selected.id;

              return (
                <button
                  key={role.id}
                  id={`${baseId}-tab-${role.id}`}
                  type="button"
                  role="tab"
                  className={cn(
                    "relative min-h-11 px-3 py-2 text-sm tracking-tight text-muted-foreground",
                    selectedTab && "text-foreground",
                  )}
                  aria-selected={selectedTab}
                  aria-controls={`${baseId}-panel-${role.id}`}
                  tabIndex={selectedTab ? 0 : -1}
                  onClick={() => selectRole(role.id)}
                  onKeyDown={(event) => onTabKeyDown(event, index)}
                >
                  {role.label}
                  {selectedTab ? (
                    <motion.span
                      layoutId={instant ? undefined : "role-tab-line"}
                      className="absolute right-3 bottom-0 left-3 h-0.5 bg-primary"
                      transition={motionTokens.spring.snappy}
                    />
                  ) : null}
                </button>
              );
            })}
          </div>

          {roles.map((role) => {
            const hidden = role.id !== selected.id;

            return (
              <div
                key={role.id}
                id={`${baseId}-panel-${role.id}`}
                role="tabpanel"
                aria-labelledby={`${baseId}-tab-${role.id}`}
                hidden={hidden}
                className="pt-8"
              >
                <AnimatePresence initial={false}>
                  {hidden ? null : (
                    <motion.div
                      key={role.id}
                      className="grid gap-8 lg:grid-cols-[minmax(0,1.2fr)_minmax(0,0.8fr)]"
                      initial={
                        instant
                          ? false
                          : {
                              opacity: 0,
                              x: direction * 28,
                              y: 12,
                            }
                      }
                      animate={{ opacity: 1, x: 0, y: 0 }}
                      transition={{
                        duration: instant ? 0 : 0.38,
                        ease: motionTokens.ease.out,
                      }}
                    >
                      <div>
                        <p className="font-mono text-label text-primary">
                          Question
                        </p>
                        <p className="mt-2 text-title">{role.question}</p>
                        <dl className="mt-8 space-y-5">
                          <div>
                            <dt className="font-mono text-label text-muted-foreground">
                              Visibility problem
                            </dt>
                            <dd className="mt-2 max-w-xl text-muted-foreground">
                              {role.problem}
                            </dd>
                          </div>
                          <div>
                            <dt className="font-mono text-label text-muted-foreground">
                              Rivqo outcome
                            </dt>
                            <dd className="mt-2 max-w-xl">{role.outcome}</dd>
                          </div>
                        </dl>
                      </div>

                      <aside
                        className="border border-border bg-background p-4"
                        aria-label={role.interfaceTitle}
                      >
                        <p className="font-mono text-label text-muted-foreground">
                          {role.interfaceTitle}
                        </p>
                        <ul className="mt-4 divide-y divide-border border-t border-border">
                          {role.interfaceRows.map((row, rowIndex) => (
                            <motion.li
                              key={row.label}
                              className="flex flex-col gap-2 py-3 sm:flex-row sm:items-center sm:justify-between"
                              initial={instant ? false : { opacity: 0, y: 16 }}
                              animate={{ opacity: 1, y: 0 }}
                              transition={{
                                delay: instant
                                  ? 0
                                  : 0.12 +
                                    rowIndex * motionTokens.stagger.tight,
                                duration: instant ? 0 : 0.4,
                                ease: motionTokens.ease.out,
                              }}
                            >
                              <span>{row.label}</span>
                              <StatusLabel tone={row.tone}>
                                {row.status}
                              </StatusLabel>
                            </motion.li>
                          ))}
                        </ul>
                      </aside>
                    </motion.div>
                  )}
                </AnimatePresence>
              </div>
            );
          })}
        </InViewReveal>
      </Container>
    </section>
  );
}
