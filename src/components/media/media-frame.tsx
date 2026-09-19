import Image from "next/image";
import { MediaReveal } from "@/components/media/media-reveal";
import { objectPosition } from "@/lib/images";
import { cn } from "@/lib/utils";
import type { SiteImage } from "@/types/images";

type MediaFrameProps = {
  image: SiteImage;
  sizes: string;
  fill?: boolean;
  priority?: boolean;
  className?: string;
  reveal?: boolean;
};

export function MediaFrame({
  image,
  sizes,
  fill = false,
  priority = false,
  className,
  reveal = true,
}: MediaFrameProps) {
  if (image.readiness !== "confirmed") {
    return null;
  }

  const treatment = image.treatment ?? "plate";
  const alt = image.decorative ? "" : image.alt;
  const caption = image.caption;
  const credit = image.credit;
  const label = image.contextLabel;
  const frame = (
    <figure
      className={cn("media-frame", `media-frame-${treatment}`, className)}
      data-media={image.id}
    >
      <div
        className="media-crop"
        style={
          fill
            ? undefined
            : { aspectRatio: image.aspectRatio.replaceAll(" ", "") }
        }
      >
        {fill ? (
          <Image
            src={image.src}
            alt={alt}
            fill
            sizes={sizes}
            quality={75}
            priority={priority}
            style={{ objectPosition: objectPosition(image.focal) }}
            className="media-image object-cover"
          />
        ) : (
          <Image
            src={image.src}
            alt={alt}
            width={image.width}
            height={image.height}
            sizes={sizes}
            quality={75}
            priority={priority}
            style={{ objectPosition: objectPosition(image.focal) }}
            className="media-image h-full w-full object-cover"
          />
        )}
        {label ? <p className="media-label">{label}</p> : null}
      </div>
      {caption || credit ? (
        <figcaption className="media-caption">
          {caption ? <span>{caption}</span> : null}
          {credit ? <span className="media-credit">{credit}</span> : null}
        </figcaption>
      ) : null}
    </figure>
  );

  return reveal ? <MediaReveal>{frame}</MediaReveal> : frame;
}
