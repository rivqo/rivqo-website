export function chatwootBaseUrl() {
  return (
    process.env.NEXT_PUBLIC_CHATWOOT_BASE_URL?.trim().replace(/\/$/, "") ?? ""
  );
}

export function chatwootWebsiteToken() {
  return process.env.NEXT_PUBLIC_CHATWOOT_WEBSITE_TOKEN?.trim() ?? "";
}

export function shouldLoadChatwoot() {
  return Boolean(chatwootBaseUrl() && chatwootWebsiteToken());
}
