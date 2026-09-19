"use client";

import Link from "next/link";
import { useEffect, useId, useState } from "react";
import { deliveryJourney } from "@/data/method";

type StageId = (typeof deliveryJourney.stages)[number]["id"];

export function DeliveryJourney() {
  const labelId = useId();
  const [active, setActive] = useState<StageId>("diagnose");
  const current =
    deliveryJourney.stages.find((stage) => stage.id === active) ??
    deliveryJourney.stages[0];

  useEffect(() => {
    const observed = ["diagnose", "prove", "deploy", "improve"] as const;
    const nodes = observed
      .map((id) => document.getElementById(id))
      .filter((node): node is HTMLElement => Boolean(node));

    if (nodes.length === 0) {
      return;
    }

    const observer = new IntersectionObserver(
      (entries) => {
        const visible = entries
          .filter((entry) => entry.isIntersecting)
          .sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];
        const id = visible?.target.id;
        if (
          id === "diagnose" ||
          id === "prove" ||
          id === "deploy" ||
          id === "improve"
        ) {
          setActive(id);
        }
      },
      { rootMargin: "-20% 0px -55% 0px", threshold: [0.2, 0.45] },
    );

    for (const node of nodes) {
      observer.observe(node);
    }

    return () => observer.disconnect();
  }, []);

  return (
    <section
      aria-labelledby="delivery-journey-heading"
      className="section-space border-t border-border"
    >
      <h2 id="delivery-journey-heading">{deliveryJourney.heading}</h2>
      <p className="mt-4 max-w-2xl text-muted-foreground">
        {deliveryJourney.introduction}
      </p>

      <div className="delivery-journey mt-10">
        <div role="group" aria-labelledby={labelId} className="journey-steps">
          <p id={labelId} className="sr-only">
            Delivery stages. Selecting a stage shows its output.
          </p>
          {deliveryJourney.stages.map((stage, index) => (
            <button
              key={stage.id}
              type="button"
              aria-pressed={stage.id === active}
              className="journey-step"
              onClick={() => setActive(stage.id)}
              onFocus={() => setActive(stage.id)}
            >
              <span className="font-mono text-label text-muted-foreground">
                {stage.number}
              </span>
              <span className="mt-2 block text-left text-sm font-medium tracking-tight">
                {stage.title}
              </span>
              {index < deliveryJourney.stages.length - 1 ? (
                <span aria-hidden="true" className="journey-rule" />
              ) : null}
            </button>
          ))}
        </div>

        <div className="journey-artifact" data-artifact={current.artifact}>
          <p className="font-mono text-label text-primary">{current.output}</p>
          <p className="mt-2 text-lg font-medium tracking-tight">
            {current.title}
          </p>
          <p className="mt-3 text-sm text-muted-foreground">{current.note}</p>
          <JourneyArtifact kind={current.artifact} />
          <Link
            href={current.href}
            className="mt-6 inline-flex text-sm font-medium text-primary underline-offset-4 hover:underline"
          >
            Read this stage
          </Link>
        </div>
      </div>
    </section>
  );
}

function JourneyArtifact({
  kind,
}: {
  kind: (typeof deliveryJourney.stages)[number]["artifact"];
}) {
  if (kind === "current-state") {
    return (
      <ol className="artifact-trail mt-6">
        <li>Request raised</li>
        <li>Approval in mail</li>
        <li>Order off-system</li>
        <li>Status reconstructed</li>
      </ol>
    );
  }

  if (kind === "register") {
    return (
      <ul className="artifact-register mt-6">
        <li>
          <span>REQ-ageing</span>
          <span>Prove first</span>
        </li>
        <li>
          <span>Evidence gaps</span>
          <span>Later</span>
        </li>
        <li>
          <span>Report rebuild</span>
          <span>Depends on trail</span>
        </li>
      </ul>
    );
  }

  if (kind === "pilot") {
    return (
      <dl className="artifact-pilot mt-6">
        <div>
          <dt>Workflow</dt>
          <dd>One named path</dd>
        </div>
        <div>
          <dt>Users</dt>
          <dd>Bounded group</dd>
        </div>
        <div>
          <dt>Success</dt>
          <dd>Agreed in the charter</dd>
        </div>
      </dl>
    );
  }

  if (kind === "workflow") {
    return (
      <p className="artifact-join mt-6">
        Request <span aria-hidden="true">→</span> approval{" "}
        <span aria-hidden="true">→</span> commitment{" "}
        <span aria-hidden="true">→</span> evidence
      </p>
    );
  }

  return (
    <ul className="artifact-review mt-6">
      <li>Adoption in the live path</li>
      <li>Exception ageing</li>
      <li>Automation only if the record holds</li>
    </ul>
  );
}
