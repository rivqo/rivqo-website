import type { StatusTone } from "@/types/homepage";
import { cn } from "@/lib/utils";

type StatusLabelProps = {
  tone: StatusTone;
  pulse?: boolean;
  children: React.ReactNode;
};

export function StatusLabel({
  tone,
  pulse = false,
  children,
}: StatusLabelProps) {
  return (
    <span
      className={cn(
        "status-label",
        tone === "ok" && "status-ok",
        tone === "warning" && "status-warning",
        tone === "critical" && "status-critical",
        tone === "neutral" && "status-neutral",
        pulse && (tone === "warning" || tone === "critical") && "status-pulse",
      )}
    >
      {children}
    </span>
  );
}
