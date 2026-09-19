import Link from "next/link";
import { aboutExperience } from "@/data/about";

export function FounderComposition() {
  return (
    <section
      aria-labelledby="experience-heading"
      className="section-space border-b border-border"
    >
      <h2 id="experience-heading">{aboutExperience.heading}</h2>
      <p className="mt-4 max-w-2xl text-muted-foreground">
        {aboutExperience.introduction}
      </p>

      <div className="experience-join mt-10">
        {aboutExperience.bands.map((band) => (
          <article
            key={band.id}
            className="experience-band"
            data-band={band.id}
          >
            <h3 className="font-mono text-label text-primary">{band.label}</h3>
            <ul className="mt-4 space-y-2 text-sm text-muted-foreground">
              {band.items.map((item) => (
                <li key={item}>{item}</li>
              ))}
            </ul>
          </article>
        ))}
        <p className="experience-core">{aboutExperience.join}</p>
      </div>

      <div className="mt-12">
        <h3 className="font-mono text-label text-muted-foreground">
          {aboutExperience.industriesHeading}
        </h3>
        <ul className="mt-4 flex flex-wrap gap-x-6 gap-y-3">
          {aboutExperience.industries.map((item) => (
            <li key={item.href}>
              <Link
                href={item.href}
                className="text-sm text-foreground underline-offset-4 hover:text-primary hover:underline"
              >
                {item.label}
              </Link>
            </li>
          ))}
        </ul>
      </div>
    </section>
  );
}
