import { ArrowRight, ChevronRight } from "lucide-react"

import { Button } from "@/components/ui/button"
import ProductCard from "@/components/product-card"
import ClientLogos from "@/components/client-logos"
import MinimalistPattern from "@/components/minimalist-pattern"
import ContactForm from "@/components/contact-form"
import FadeIn from "@/components/animations/fade-in"
import StaggerChildren from "@/components/animations/stagger-children"
import CountUp from "@/components/animations/count-up"
import SplashScreen from "@/components/splash-screen"
import NavigationProgress from "@/components/navigation-progress"
import ScrollToTop from "@/components/scroll-to-top"
import ParallaxSection from "@/components/parallax-section"
import { ParallaxElement, FloatingElement, RotatingElement } from "@/components/parallax-elements"
import {
  CircleShape,
  SquareShape,
  TriangleShape,
  DonutShape,
  HexagonShape,
  PlusShape,
} from "@/components/parallax-shapes"

export default function Home() {
  return (
    <div className="flex flex-col min-h-screen">
      {/* <SplashScreen /> */}
      <NavigationProgress />
      <ScrollToTop />
      <main className="flex-1">
        {/* Hero Section with Gradient and Parallax */}
        <ParallaxSection
          className="relative w-full py-40 md:py-32 lg:py-40 overflow-hidden"
          bgClassName="bg-gradient-to-br from-[#00664E] to-[#3EBA9E] opacity-90"
          speed={0.2}
          direction="up"
        >
          <MinimalistPattern className="absolute inset-0 opacity-10" />

          {/* Parallax Decorative Elements */}
          <ParallaxElement className="absolute top-80 md:top-20 opacity-0 md:opacity-1 left-10 text-white/10 w-32 h-32" speed={0.3} direction="down">
            <CircleShape />
          </ParallaxElement>

          <ParallaxElement className="absolute bottom-20 right-10 text-white/10 w-40 h-40" speed={0.5} direction="up">
            <HexagonShape />
          </ParallaxElement>

          <FloatingElement className="absolute top-1/4 right-1/4 text-white/10 w-16 h-16" amplitude={15} duration={5}>
            <SquareShape />
          </FloatingElement>

          <RotatingElement className="absolute bottom-0 md:bottom-1/3 left-1/2 md:left-1/4 text-white/10 w-24 h-24">
            <PlusShape />
          </RotatingElement>

          <div className="container relative px-4 md:px-6 z-10">
            <div className="flex flex-col items-start md:items-center justify-center text-center max-w-3xl mx-auto space-y-8">
              <FadeIn direction="down" duration={0.7}>
                <h1 className="text-4xl font-bold text-left md:text-center tracking-tighter sm:text-4xl md:text-5xl lg:text-6xl/none text-white">
                  Building impactful software for African growth
                </h1>
              </FadeIn>
              <FadeIn delay={0.2} duration={0.7}>
                <p className="max-w-[600px] text-xl text-left md:text-center text-white/90 md:text-xl">
                  We create innovative software solutions that empower businesses and individuals across Africa to
                  thrive in the digital economy.
                </p>
              </FadeIn>
              <FadeIn delay={0.4} duration={0.7}>
                <div className="flex flex-col gap-4 sm:flex-row">
                  <Button className="px-8 bg-white text-[#00664E] hover:bg-white/90">
                    Explore our products
                    <ArrowRight className="ml-2 h-4 w-4" />
                  </Button>
                  <Button
                    variant="outline"
                    className="px-8 border-white text-white bg-[#3EBA9E]/30 hover:bg-[#3EBA9E]/40"
                  >
                    Our services
                  </Button>
                </div>
              </FadeIn>
            </div>
          </div>
        </ParallaxSection>

        {/* Stats Section */}
        {/* <section className="relative w-full py-12 md:py-16 bg-white">
          <div className="container px-4 md:px-6">
            <div className="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
              <div className="space-y-2">
                <CountUp end={4} suffix="+" className="text-4xl font-bold text-[#00664E]" />
                <p className="text-gray-600">Products</p>
              </div>
              <div className="space-y-2">
                <CountUp end={50} suffix="+" className="text-4xl font-bold text-[#00664E]" />
                <p className="text-gray-600">Clients</p>
              </div>
              <div className="space-y-2">
                <CountUp end={100} suffix="+" className="text-4xl font-bold text-[#00664E]" />
                <p className="text-gray-600">Projects</p>
              </div>
              <div className="space-y-2">
                <CountUp end={5} suffix="+" className="text-4xl font-bold text-[#00664E]" />
                <p className="text-gray-600">Years Experience</p>
              </div>
            </div>
          </div>
        </section> */}

        {/* Products Section with Parallax */}
        <ParallaxSection className="relative w-full py-20 md:py-32" speed={0.1} direction="up">
          <MinimalistPattern className="absolute inset-0 opacity-5" />

          {/* Parallax Decorative Elements */}
          <ParallaxElement className="absolute top-40 left-20 text-[#00664E]/5 w-24 h-24" speed={0.4} direction="down">
            <DonutShape />
          </ParallaxElement>

          <ParallaxElement
            className="absolute bottom-40 right-20 text-[#3EBA9E]/5 w-32 h-32"
            speed={0.3}
            direction="up"
          >
            <TriangleShape />
          </ParallaxElement>

          <div className="container relative px-4 md:px-6 z-10">
            <FadeIn>
              <div className="flex flex-col items-center justify-center space-y-4 text-center">
                <div className="space-y-2">
                  <h2 className="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-[#00664E]">
                    Our Products
                  </h2>
                  <p className="max-w-[900px] text-gray-600 md:text-xl/relaxed lg:text-base/relaxed xl:text-xl/relaxed">
                    Innovative software solutions designed to solve real problems for Africans
                  </p>
                </div>
              </div>
            </FadeIn>
            <StaggerChildren className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-12" staggerDelay={0.1}>
              <div>
                <ProductCard
                  title="VeezoCard"
                  description="Digital business card and WhatsApp store builder"
                  icon="credit-card"
                />
              </div>
              <div>
                <ProductCard title="Noctua" description="Complete school management system" icon="school" />
              </div>
              <div>
                <ProductCard title="Swiifta" description="Comprehensive bill payments API" icon="credit-card" />
              </div>
              <div>
                <ProductCard
                  title="Resume Builder"
                  description="Create simple, professional resumes with ease"
                  icon="file-text"
                />
              </div>
            </StaggerChildren>
          </div>
        </ParallaxSection>

        {/* Services Section with Parallax */}
        <ParallaxSection className="relative w-full py-20 md:py-32 bg-gray-50" speed={0.15} direction="up">
          <MinimalistPattern className="absolute inset-0 opacity-5" />

          {/* Parallax Decorative Elements */}
          <ParallaxElement
            className="absolute top-1/4 left-10 text-[#00664E]/5 w-20 h-20"
            speed={0.25}
            direction="right"
          >
            <PlusShape />
          </ParallaxElement>

          <ParallaxElement
            className="absolute bottom-1/4 right-10 text-[#3EBA9E]/5 w-28 h-28"
            speed={0.35}
            direction="left"
          >
            <CircleShape />
          </ParallaxElement>

          <div className="container relative px-4 md:px-6 z-10">
            <FadeIn>
              <div className="flex flex-col items-center justify-center space-y-4 text-center max-w-3xl mx-auto">
                <div className="space-y-2">
                  <h2 className="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-[#00664E]">
                    Custom Software Development
                  </h2>
                  <p className="max-w-[700px] text-gray-600 md:text-xl">
                    We help businesses bring their ideas to life with professional software development services. From
                    concept to launch, we handle every aspect of the development process.
                  </p>
                </div>
              </div>
            </FadeIn>

            <StaggerChildren className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-12" staggerDelay={0.1}>
              <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:border-[#3EBA9E]/30 group">
                <div className="w-12 h-12 bg-[#3EBA9E]/10 rounded-full flex items-center justify-center mb-4 transition-transform duration-500 transform group-hover:scale-110">
                  <ChevronRight className="h-6 w-6 text-[#3EBA9E]" />
                </div>
                <h3 className="text-lg font-medium text-[#00664E] mb-2">Product Strategy</h3>
                <p className="text-gray-600">
                  Define your product vision and roadmap with our strategic planning services.
                </p>
              </div>

              <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:border-[#3EBA9E]/30 group">
                <div className="w-12 h-12 bg-[#3EBA9E]/10 rounded-full flex items-center justify-center mb-4 transition-transform duration-500 transform group-hover:scale-110">
                  <ChevronRight className="h-6 w-6 text-[#3EBA9E]" />
                </div>
                <h3 className="text-lg font-medium text-[#00664E] mb-2">UI/UX Design</h3>
                <p className="text-gray-600">Create intuitive, engaging user experiences with our design expertise.</p>
              </div>

              <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:border-[#3EBA9E]/30 group">
                <div className="w-12 h-12 bg-[#3EBA9E]/10 rounded-full flex items-center justify-center mb-4 transition-transform duration-500 transform group-hover:scale-110">
                  <ChevronRight className="h-6 w-6 text-[#3EBA9E]" />
                </div>
                <h3 className="text-lg font-medium text-[#00664E] mb-2">Full-stack Development</h3>
                <p className="text-gray-600">Build robust applications with our comprehensive development services.</p>
              </div>

              <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:border-[#3EBA9E]/30 group">
                <div className="w-12 h-12 bg-[#3EBA9E]/10 rounded-full flex items-center justify-center mb-4 transition-transform duration-500 transform group-hover:scale-110">
                  <ChevronRight className="h-6 w-6 text-[#3EBA9E]" />
                </div>
                <h3 className="text-lg font-medium text-[#00664E] mb-2">Quality Assurance</h3>
                <p className="text-gray-600">
                  Ensure your software meets the highest standards with our testing services.
                </p>
              </div>

              <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:border-[#3EBA9E]/30 group">
                <div className="w-12 h-12 bg-[#3EBA9E]/10 rounded-full flex items-center justify-center mb-4 transition-transform duration-500 transform group-hover:scale-110">
                  <ChevronRight className="h-6 w-6 text-[#3EBA9E]" />
                </div>
                <h3 className="text-lg font-medium text-[#00664E] mb-2">Deployment</h3>
                <p className="text-gray-600">Launch your application with confidence using our deployment expertise.</p>
              </div>

              <div className="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 hover:border-[#3EBA9E]/30 group">
                <div className="w-12 h-12 bg-[#3EBA9E]/10 rounded-full flex items-center justify-center mb-4 transition-transform duration-500 transform group-hover:scale-110">
                  <ChevronRight className="h-6 w-6 text-[#3EBA9E]" />
                </div>
                <h3 className="text-lg font-medium text-[#00664E] mb-2">Maintenance & Support</h3>
                <p className="text-gray-600">Keep your software running smoothly with our ongoing support services.</p>
              </div>
            </StaggerChildren>

            <FadeIn delay={0.4} className="flex justify-center mt-12">
              <Button className="px-8 bg-[#00664E] hover:bg-[#00664E]/90">
                Get in touch
                <ArrowRight className="ml-2 h-4 w-4" />
              </Button>
            </FadeIn>
          </div>
        </ParallaxSection>

        {/* Mission Section with Parallax */}
        <ParallaxSection className="relative w-full py-20 md:py-32" speed={0.1} direction="up">
          <MinimalistPattern className="absolute inset-0 opacity-5" />

          {/* Parallax Decorative Elements */}
          <ParallaxElement
            className="absolute top-1/3 left-1/4 text-[#00664E]/5 w-16 h-16"
            speed={0.2}
            direction="down"
          >
            <SquareShape />
          </ParallaxElement>

          <ParallaxElement
            className="absolute bottom-1/3 right-1/4 text-[#3EBA9E]/5 w-20 h-20"
            speed={0.3}
            direction="up"
          >
            <HexagonShape />
          </ParallaxElement>

          <div className="container relative px-4 md:px-6 z-10">
            <div className="flex flex-col items-center justify-center space-y-6 max-w-3xl mx-auto text-center">
              <FadeIn>
                <div className="w-16 h-16 bg-[#3EBA9E]/10 rounded-full flex items-center justify-center animate-pulse">
                  <div className="w-8 h-8 bg-[#00664E] rounded-full"></div>
                </div>
              </FadeIn>
              <FadeIn delay={0.2}>
                <div className="space-y-4">
                  <h2 className="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-[#00664E]">
                    Our Mission
                  </h2>
                  <p className="text-gray-600 md:text-xl">
                    At Rivqo, we're committed to building impactful software that fosters growth across Africa. We
                    believe in the power of technology to transform lives and businesses.
                  </p>
                  <p className="text-gray-600 md:text-xl">
                    Our goal is to create accessible, user-friendly software solutions that address real challenges
                    faced by Africans, empowering them to participate fully in the global digital economy.
                  </p>
                </div>
              </FadeIn>
              <FadeIn delay={0.4} className="pt-4">
                <Button
                  variant="outline"
                  className="px-8 border-[#00664E] text-[#00664E] bg-[#00664E]/10 hover:bg-[#00664E]/20"
                >
                  Learn more about us
                  <ArrowRight className="ml-2 h-4 w-4" />
                </Button>
              </FadeIn>
            </div>
          </div>
        </ParallaxSection>

        {/* Client Logos */}
        <section className="relative w-full py-20 md:py-32 bg-gray-50">
          <MinimalistPattern className="absolute inset-0 opacity-5" />
          <div className="container relative px-4 md:px-6 z-10">
            <FadeIn>
              <div className="flex flex-col items-center justify-center space-y-4 text-center">
                <div className="space-y-2">
                  <h2 className="text-3xl font-bold tracking-tighter text-[#00664E]">
                    Trusted by businesses across Africa
                  </h2>
                </div>
              </div>
            </FadeIn>
            <FadeIn delay={0.2}>
              <ClientLogos />
            </FadeIn>
          </div>
        </section>

        {/* Contact Form Section */}
        <section className="relative w-full py-20 md:py-32">
          <MinimalistPattern className="absolute inset-0 opacity-5" />
          <div className="container relative px-4 md:px-6 z-10">
            <FadeIn>
              <div className="flex flex-col items-center justify-center space-y-4 text-center mb-12">
                <div className="space-y-2">
                  <h2 className="text-3xl font-bold tracking-tighter sm:text-4xl text-[#00664E]">Get in Touch</h2>
                  <p className="max-w-[600px] text-gray-600 md:text-xl">
                    Have a question or want to learn more about our products and services? Reach out to us!
                  </p>
                </div>
              </div>
            </FadeIn>
            <FadeIn delay={0.3} className="max-w-2xl mx-auto">
              <ContactForm />
            </FadeIn>
          </div>
        </section>

        {/* CTA Section with Parallax */}
        <ParallaxSection
          className="relative w-full py-20 md:py-32 overflow-hidden"
          bgClassName="bg-gradient-to-br from-[#00664E] to-[#3EBA9E] opacity-90"
          speed={0.2}
          direction="up"
        >
          <MinimalistPattern className="absolute inset-0 opacity-10" />

          {/* Parallax Decorative Elements */}
          <ParallaxElement className="absolute top-20 left-20 text-white/10 w-24 h-24" speed={0.4} direction="down">
            <DonutShape />
          </ParallaxElement>

          <ParallaxElement className="absolute bottom-20 right-20 text-white/10 w-32 h-32" speed={0.3} direction="up">
            <TriangleShape />
          </ParallaxElement>

          <div className="container relative px-4 md:px-6 z-10">
            <div className="flex flex-col items-center justify-center space-y-4 text-center">
              <FadeIn direction="up">
                <div className="space-y-2">
                  <h2 className="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-white">
                    Ready to transform your business?
                  </h2>
                  <p className="max-w-[900px] text-white/90 md:text-xl">
                    Let's discuss how our software solutions can help you achieve your goals
                  </p>
                </div>
              </FadeIn>
              <FadeIn direction="up" delay={0.2}>
                <div className="flex flex-col gap-4 sm:flex-row">
                  <Button size="lg" className="px-8 bg-white text-[#00664E] hover:bg-white/90">
                    Book a consultation
                  </Button>
                  <Button
                    size="lg"
                    variant="outline"
                    className="px-8 border-white text-white bg-[#3EBA9E]/30 hover:bg-[#3EBA9E]/40"
                  >
                    View our products
                  </Button>
                </div>
              </FadeIn>
            </div>
          </div>
        </ParallaxSection>
      </main>
    </div>
  )
}
