import Link from "next/link";
import { cn } from "@/lib/utils";

const variants = {
  primary: "button-primary text-primary-foreground",
  secondary: "button-secondary text-foreground",
  quiet: "button-quiet text-foreground",
} as const;

type ButtonVariant = keyof typeof variants;

type SharedProps = {
  variant?: ButtonVariant;
  className?: string;
  children: React.ReactNode;
};

type ButtonAsButton = SharedProps &
  Omit<
    React.ButtonHTMLAttributes<HTMLButtonElement>,
    "className" | "children"
  > & {
    href?: undefined;
  };

type ButtonAsLink = SharedProps &
  Omit<
    React.AnchorHTMLAttributes<HTMLAnchorElement>,
    "className" | "children" | "href"
  > & {
    href: string;
  };

export type ButtonProps = ButtonAsButton | ButtonAsLink;

const controlClassName =
  "button-shell inline-flex min-h-11 items-center justify-center gap-2 rounded-control px-4 py-2.5 text-sm font-medium tracking-tight disabled:pointer-events-none disabled:opacity-50";

export function Button({
  variant = "primary",
  className,
  children,
  ...props
}: ButtonProps) {
  const classes = cn(controlClassName, variants[variant], className);
  const content = (
    <>
      <span aria-hidden="true" className="button-fill" />
      <span className="button-label relative z-10 inline-flex items-center gap-2">
        {children}
      </span>
    </>
  );

  if ("href" in props && typeof props.href === "string") {
    const { href, ...linkProps } = props;
    const isInternal = href.startsWith("/") || href.startsWith("#");

    if (isInternal) {
      return (
        <Link href={href} className={classes} {...linkProps}>
          {content}
        </Link>
      );
    }

    return (
      <a href={href} className={classes} {...linkProps}>
        {content}
      </a>
    );
  }

  const { type, ...buttonProps } = props;

  return (
    <button type={type ?? "button"} className={classes} {...buttonProps}>
      {content}
    </button>
  );
}
