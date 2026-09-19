import { ImageResponse } from "next/og";
import { readFile } from "node:fs/promises";
import { join } from "node:path";

export const alt = "Rivqo — Better systems for complex operations.";
export const size = { width: 1200, height: 630 };
export const contentType = "image/png";

export default async function Image() {
  const mark = await readFile(join(process.cwd(), "public/brand/mark.png"));
  const markSrc = `data:image/png;base64,${mark.toString("base64")}`;

  return new ImageResponse(
    <div
      style={{
        width: "100%",
        height: "100%",
        display: "flex",
        flexDirection: "column",
        justifyContent: "space-between",
        padding: "72px 80px",
        backgroundColor: "#f1ece4",
        backgroundImage:
          "linear-gradient(rgba(200,194,184,0.28) 1px, transparent 1px), linear-gradient(90deg, rgba(200,194,184,0.28) 1px, transparent 1px)",
        backgroundSize: "56px 56px",
        color: "#1a1f1d",
      }}
    >
      <div style={{ display: "flex", alignItems: "center", gap: "18px" }}>
        <img src={markSrc} width={64} height={65} alt="" />
        <div
          style={{
            fontSize: 34,
            letterSpacing: "-0.04em",
            fontWeight: 600,
          }}
        >
          Rivqo
        </div>
      </div>
      <div
        style={{
          display: "flex",
          flexDirection: "column",
          gap: "28px",
          maxWidth: 980,
        }}
      >
        <div
          style={{
            width: 88,
            height: 4,
            backgroundColor: "#00664e",
          }}
        />
        <div
          style={{
            fontSize: 72,
            lineHeight: 1.05,
            letterSpacing: "-0.045em",
            fontWeight: 600,
          }}
        >
          Better systems for complex operations.
        </div>
      </div>
      <div
        style={{
          display: "flex",
          justifyContent: "space-between",
          alignItems: "flex-end",
          fontSize: 22,
          color: "#00664e",
          letterSpacing: "-0.02em",
        }}
      >
        <div>Rivqo Digital LTD</div>
        <div>rivqo.com</div>
      </div>
    </div>,
    size,
  );
}
