import type { ComponentPropsWithoutRef } from "react";
import { cn } from "@/lib/utils";

type ContainerElement =
  "div" | "section" | "article" | "main" | "header" | "footer" | "nav";

type ContainerProps<T extends ContainerElement = "div"> = {
  as?: T;
  width?: "page" | "narrow";
} & Omit<ComponentPropsWithoutRef<T>, "as">;

export function Container<T extends ContainerElement = "div">({
  as,
  width = "page",
  className,
  children,
  ...props
}: ContainerProps<T>) {
  const Component = as ?? "div";

  return (
    <Component
      className={cn(
        "mx-auto w-full px-5 sm:px-6 lg:px-8",
        width === "page" && "max-w-page",
        width === "narrow" && "max-w-narrow",
        className,
      )}
      {...props}
    >
      {children}
    </Component>
  );
}
