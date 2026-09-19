import { contactPage } from "@/data/contact";

export function EngagementPath() {
  return (
    <section
      aria-labelledby="engagement-path-heading"
      className="border-b border-border"
    >
      <div className="section-space">
        <h2 id="engagement-path-heading">{contactPage.pathHeading}</h2>
        <ol className="engagement-path mt-8">
          {contactPage.path.map((step) => (
            <li key={step.number} className="engagement-step">
              <p className="font-mono text-label text-primary">{step.number}</p>
              <h3 className="mt-3 text-lg font-medium tracking-tight">
                {step.title}
              </h3>
              <p className="mt-3 text-sm text-muted-foreground">{step.body}</p>
            </li>
          ))}
        </ol>
      </div>
    </section>
  );
}
