import Image from "next/image"
import { ArrowRight } from "lucide-react"

import { Button } from "@/components/ui/button"
import ProductCard from "@/components/product-card"

export default function ProductsPage() {
  return (
    <div className="flex flex-col min-h-screen">
      <main className="flex-1">
        {/* Hero Section */}
        <section className="w-full py-12 md:py-24 lg:py-32 bg-gray-50 dark:bg-gray-900">
          <div className="container px-4 md:px-6">
            <div className="flex flex-col items-center justify-center space-y-4 text-center">
              <div className="space-y-2">
                <h1 className="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl lg:text-6xl/none">
                  Our Products
                </h1>
                <p className="max-w-[900px] text-gray-500 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed dark:text-gray-400">
                  Innovative software solutions designed to solve real problems for Africans
                </p>
              </div>
            </div>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-12">
              <ProductCard
                title="VeezoCard"
                description="Digital business card and WhatsApp store builder"
                icon="credit-card"
              />
              <ProductCard title="Swiifta" description="Comprehensive bill payments API" icon="credit-card" />
              <ProductCard
                title="peakCV"
                description="Create simple, professional resumes with ease"
                icon="file-text"
              />
              <ProductCard title="Noctua" description="Complete school management system" icon="school" />
            </div>
          </div>
        </section>

        {/* Product Details */}
        <section className="w-full py-12 md:py-24">
          <div className="container px-4 md:px-6">
            <div className="grid gap-12">
              {/* VeezoCard */}
              <div className="grid gap-6 lg:grid-cols-2 lg:gap-12 items-center">
                <div className="flex flex-col justify-center space-y-4">
                  <div className="space-y-2">
                    <h2 className="text-3xl font-bold tracking-tighter sm:text-4xl">VeezoCard</h2>
                    <p className="max-w-[600px] text-gray-500 md:text-xl dark:text-gray-400">
                      Create digital business cards and build WhatsApp stores with ease. Connect with customers and
                      showcase your products in a modern, digital format.
                    </p>
                  </div>
                  <ul className="grid gap-2">
                    <li className="flex items-center gap-2">
                      <ArrowRight className="h-4 w-4 text-primary" />
                      <span>Digital business cards with customizable templates</span>
                    </li>
                    <li className="flex items-center gap-2">
                      <ArrowRight className="h-4 w-4 text-primary" />
                      <span>WhatsApp store builder with product catalog</span>
                    </li>
                    <li className="flex items-center gap-2">
                      <ArrowRight className="h-4 w-4 text-primary" />
                      <span>Analytics and customer insights</span>
                    </li>
                    <li className="flex items-center gap-2">
                      <ArrowRight className="h-4 w-4 text-primary" />
                      <span>Seamless payment integration</span>
                    </li>
                  </ul>
                  <div>
                    <Button className="px-8">
                      Learn more
                      <ArrowRight className="ml-2 h-4 w-4" />
                    </Button>
                  </div>
                </div>
                <div className="flex items-center justify-center">
                  <div className="relative w-full h-[400px]">
                    <Image
                      src="/placeholder.svg?height=400&width=600"
                      alt="VeezoCard"
                      fill
                      className="object-cover rounded-lg"
                    />
                  </div>
                </div>
              </div>

              {/* Swiifta */}
              <div className="grid gap-6 lg:grid-cols-2 lg:gap-12 items-center">
                <div className="flex items-center justify-center order-2 lg:order-1">
                  <div className="relative w-full h-[400px]">
                    <Image
                      src="/placeholder.svg?height=400&width=600"
                      alt="Swiifta"
                      fill
                      className="object-cover rounded-lg"
                    />
                  </div>
                </div>
                <div className="flex flex-col justify-center space-y-4 order-1 lg:order-2">
                  <div className="space-y-2">
                    <h2 className="text-3xl font-bold tracking-tighter sm:text-4xl">Swiifta</h2>
                    <p className="max-w-[600px] text-gray-500 md:text-xl dark:text-gray-400">
                      A comprehensive bill payments API that enables businesses to offer payment services to their
                      customers. Simplify transactions and expand your service offerings.
                    </p>
                  </div>
                  <ul className="grid gap-2">
                    <li className="flex items-center gap-2">
                      <ArrowRight className="h-4 w-4 text-primary" />
                      <span>Utility bill payments (electricity, water, etc.)</span>
                    </li>
                    <li className="flex items-center gap-2">
                      <ArrowRight className="h-4 w-4 text-primary" />
                      <span>Airtime and data purchases</span>
                    </li>
                    <li className="flex items-center gap-2">
                      <ArrowRight className="h-4 w-4 text-primary" />
                      <span>Secure payment processing</span>
                    </li>
                    <li className="flex items-center gap-2">
                      <ArrowRight className="h-4 w-4 text-primary" />
                      <span>Comprehensive transaction reporting</span>
                    </li>
                  </ul>
                  <div>
                    <Button className="px-8">
                      Learn more
                      <ArrowRight className="ml-2 h-4 w-4" />
                    </Button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* CTA Section */}
        <section className="w-full py-12 md:py-24 bg-primary text-primary-foreground">
          <div className="container px-4 md:px-6">
            <div className="flex flex-col items-center justify-center space-y-4 text-center">
              <div className="space-y-2">
                <h2 className="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl">Ready to get started?</h2>
                <p className="max-w-[900px] md:text-xl/relaxed">
                  Explore our products and find the perfect solution for your business needs
                </p>
              </div>
              <div className="flex flex-col gap-2 min-[400px]:flex-row">
                <Button variant="secondary" size="lg" className="px-8">
                  Book a demo
                </Button>
                <Button
                  variant="outline"
                  size="lg"
                  className="px-8 bg-primary-foreground text-primary hover:bg-primary-foreground/90"
                >
                  Contact sales
                </Button>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>
  )
}
