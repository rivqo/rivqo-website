import { ViewTransition } from "react";

type PageTransitionProps = {
  children: React.ReactNode;
};

/**
 * Soft route enter/exit via the View Transitions API.
 * Lives in `template.tsx` so it remounts on navigation (unlike layouts).
 */
export function PageTransition({ children }: PageTransitionProps) {
  return (
    <ViewTransition enter="page-enter" exit="page-exit" default="none">
      {children}
    </ViewTransition>
  );
}
