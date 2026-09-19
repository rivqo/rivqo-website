"use client";

import { useRef } from "react";
import { Button } from "@/components/ui/button";
import { Container } from "@/components/layout/container";
import { Entrance } from "@/components/motion/entrance";
import { ParallaxLayer } from "@/components/motion/parallax-layer";
import { HeroHeadline } from "@/components/motion/text-reveal";
import { OperationalFlow } from "@/components/sections/operational-flow";
import { hero } from "@/data/homepage";
import { motionTokens } from "@/lib/motion";
import { site } from "@/data/site";

export function HeroSection() {
  const storyRef = useRef<HTMLElement>(null);

  return (
    <section
      ref={storyRef}
      aria-labelledby="hero-heading"
      className="hero-story relative border-b border-border"
    >
      <div
        aria-hidden="true"
        className="hero-grid pointer-events-none absolute inset-0"
      />
      <div className="hero-sticky">
        <Container className="grid items-start gap-12 xl:grid-cols-[minmax(0,1fr)_26rem] xl:gap-14">
          <ParallaxLayer
            className="relative z-10 min-w-0"
            to={-48}
            fade
            target={storyRef}
          >
            <Entrance delay={0.16} y={22}>
              <p className="font-mono text-label text-primary">
                {hero.eyebrow}
              </p>
            </Entrance>
            <HeroHeadline
              id="hero-heading"
              className="mt-4"
              lines={[
                "Run complex projects",
                "without chasing people",
                "for answers.",
              ]}
            />
            <Entrance delay={0.42} y={motionTokens.reveal.body}>
              <p className="mt-6 max-w-xl text-lede text-muted-foreground">
                {hero.support}
              </p>
            </Entrance>
            <Entrance delay={0.52} y={24}>
              <div className="mt-8 flex flex-wrap gap-3">
                <Button href={site.cta.href} data-cta="hero-primary">
                  {site.cta.label}
                </Button>
                <Button
                  href={hero.secondaryCta.href}
                  variant="secondary"
                  data-cta="hero-secondary"
                >
                  {hero.secondaryCta.label}
                </Button>
              </div>
            </Entrance>
            <Entrance delay={0.62} y={18}>
              <p className="mt-6 max-w-md text-sm text-muted-foreground">
                {hero.trust}
              </p>
            </Entrance>
          </ParallaxLayer>

          <ParallaxLayer className="min-w-0 w-full" to={28} target={storyRef}>
            <Entrance
              delay={0.36}
              y={40}
              scale={motionTokens.scale.enter}
              className="relative z-10 w-full"
            >
              <OperationalFlow progressSource={storyRef} />
            </Entrance>
          </ParallaxLayer>
        </Container>
      </div>
    </section>
  );
}
