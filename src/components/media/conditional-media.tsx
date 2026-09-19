import { MediaFrame } from "@/components/media/media-frame";
import { getConfirmedImage } from "@/lib/images";

type ConditionalMediaProps = {
  id: string;
  sizes: string;
  priority?: boolean;
  className?: string;
};

export function ConditionalMedia({
  id,
  sizes,
  priority = false,
  className,
}: ConditionalMediaProps) {
  const image = getConfirmedImage(id);

  if (!image) {
    return null;
  }

  return (
    <MediaFrame
      image={image}
      sizes={sizes}
      priority={priority}
      className={className}
    />
  );
}
