import type { ReactNode } from "react";

type ViewTransitionClass = string | Record<string, string>;

declare module "react" {
  export type ViewTransitionProps = {
    children?: ReactNode;
    name?: string;
    enter?: ViewTransitionClass;
    exit?: ViewTransitionClass;
    share?: ViewTransitionClass;
    update?: ViewTransitionClass;
    default?: ViewTransitionClass;
  };

  export function ViewTransition(props: ViewTransitionProps): ReactNode;
}
