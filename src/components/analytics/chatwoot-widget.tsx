import Script from "next/script";
import {
  chatwootBaseUrl,
  chatwootWebsiteToken,
  shouldLoadChatwoot,
} from "@/lib/chatwoot";

export function ChatwootWidget() {
  const baseUrl = chatwootBaseUrl();
  const token = chatwootWebsiteToken();

  if (!shouldLoadChatwoot()) {
    return null;
  }

  const runtime = JSON.stringify({ baseUrl, token });

  return (
    <Script id="chatwoot-widget" strategy="afterInteractive">
      {`
        (function (d, t) {
          var config = ${runtime};
          var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
          g.src = config.baseUrl + "/packs/js/sdk.js";
          g.async = true;
          s.parentNode.insertBefore(g, s);
          g.onload = function () {
            window.chatwootSDK.run({
              websiteToken: config.token,
              baseUrl: config.baseUrl
            });
          };
        })(document, "script");
      `}
    </Script>
  );
}
