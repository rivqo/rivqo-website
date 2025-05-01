import type React from "react"
import type { Metadata } from "next"
import { Inter } from "next/font/google"
import "./globals.css"
import Header from "@/components/header"
import Footer from "@/components/footer"
import { ThemeProvider } from "@/components/theme-provider"
import PageTransition from "@/components/page-transition"

const inter = Inter({ subsets: ["latin"] })

export const metadata: Metadata = {
  title: "Rivqo - Building Impactful Software for Impactful People",
  description:
    "Rivqo is a software company aimed at building impactful software for great people to foster growth. Our products include VeezoCard, Swiifta, Resume Builder, and Noctua.",
  icons: {
    icon: "/riv-fac.png",
  },
  openGraph: {
    type: "website",
    url: "https://rivqo.com/",
    title: "Rivqo - Building Impactful Software for Impactful People",
    description:
      "Rivqo is a software company aimed at building impactful software for great people to foster growth. Our products include VeezoCard, Swiifta, Resume Builder, and Noctua.",
    images: [
      {
        url: "/images/preview-image.png",
        width: 1200,
        height: 630,
        alt: "Rivqo Preview Image",
      },
    ],
  },
  twitter: {
    card: "summary_large_image",
    title: "Rivqo - Building Impactful Software for Impactful People",
    description:
      "Rivqo is a software company aimed at building impactful software for great people to foster growth. Our products include VeezoCard, Swiifta, Resume Builder, and Noctua.",
    images: ["/images/preview-image.png"],
    site: "@your_twitter_handle", // optional
  },
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode
}>) {
  return (
    <html lang="en">
      <body className={inter.className}>
        <ThemeProvider attribute="class" defaultTheme="light" enableSystem disableTransitionOnChange>
          <Header />
          <PageTransition>{children}</PageTransition>
          <Footer />
        </ThemeProvider>
      </body>
    </html>
  )
}
