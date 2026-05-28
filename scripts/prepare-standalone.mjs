#!/usr/bin/env node
/**
 * Prepares the Next.js standalone output for execution.
 *
 * With `output: "standalone"` in next.config.mjs, `next build` produces
 * `.next/standalone/server.js` but does NOT copy `public/` or `.next/static`
 * next to it. Without this script, `node .next/standalone/server.js` runs
 * but cannot serve images, fonts, or any static asset.
 *
 * This script runs after `next build` (via the `build` npm script) and
 * mirrors what the Dockerfile already does at the COPY layer, so deploy
 * targets that just run `npm run build && npm start` work correctly.
 *
 * Cross-platform: uses Node's built-in fs.cpSync (Node >= 16.7).
 */
import { cpSync, existsSync } from "node:fs"
import { resolve } from "node:path"

const ROOT = process.cwd()
const STANDALONE = resolve(ROOT, ".next", "standalone")

if (!existsSync(STANDALONE)) {
  console.log(
    "[prepare-standalone] No .next/standalone directory found — skipping. " +
      'Enable `output: "standalone"` in next.config.mjs if you want this step to run.'
  )
  process.exit(0)
}

const copies = [
  { from: resolve(ROOT, "public"), to: resolve(STANDALONE, "public") },
  {
    from: resolve(ROOT, ".next", "static"),
    to: resolve(STANDALONE, ".next", "static"),
  },
]

for (const { from, to } of copies) {
  if (!existsSync(from)) {
    console.log(`[prepare-standalone] Skipping missing source: ${from}`)
    continue
  }
  cpSync(from, to, { recursive: true })
  console.log(`[prepare-standalone] Copied ${from} -> ${to}`)
}

console.log("[prepare-standalone] Standalone bundle ready.")
