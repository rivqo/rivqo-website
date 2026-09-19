type OutcomePanelProps = {
  label?: string;
  children: React.ReactNode;
};

export function OutcomePanel({
  label = "Management outcome",
  children,
}: OutcomePanelProps) {
  return (
    <p className="border-l-2 border-primary bg-muted/70 px-4 py-3">
      <span className="block font-mono text-label text-primary">{label}</span>
      <span className="mt-2 block">{children}</span>
    </p>
  );
}
