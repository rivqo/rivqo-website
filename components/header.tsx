"use client"

import React from "react"

import { useState, useEffect } from "react"
import Link from "next/link"
import Image from "next/image"
import { Menu, X } from "lucide-react"

import { Button } from "@/components/ui/button"
import {
  NavigationMenu,
  NavigationMenuContent,
  NavigationMenuItem,
  NavigationMenuLink,
  NavigationMenuList,
  NavigationMenuTrigger,
  navigationMenuTriggerStyle,
} from "@/components/ui/navigation-menu"
import { cn } from "@/lib/utils"

export default function Header() {
  const [isMenuOpen, setIsMenuOpen] = useState(false)
  const [scrolled, setScrolled] = useState(false)

  useEffect(() => {
    const handleScroll = () => {
      const isScrolled = window.scrollY > 10
      if (isScrolled !== scrolled) {
        setScrolled(isScrolled)
      }
    }

    window.addEventListener("scroll", handleScroll)
    return () => {
      window.removeEventListener("scroll", handleScroll)
    }
  }, [scrolled])

  return (
    <div className="fixed top-0 z-50 flex justify-center w-full px-4 pt-4">
      <header
        className={cn(
          "w-full max-w-7xl rounded-full border backdrop-blur supports-[backdrop-filter]:bg-background/60 transition-all duration-300",
          scrolled ? "bg-background/95 shadow-lg" : "bg-background/80 shadow-md",
        )}
      >
        <div className="container flex h-16 items-center justify-between">
          <div className="flex items-center gap-2">
            <Link href="/" className="flex items-center gap-2 transition-transform duration-300 hover:scale-105">
              <Image src="/images/rivqo-logo.png" alt="Rivqo Logo" width={100} height={40} />
            </Link>
          </div>

          {/* Desktop Navigation */}
          <NavigationMenu className="hidden md:flex">
            <NavigationMenuList>
              <NavigationMenuItem>
                <NavigationMenuTrigger className="text-[#00664E] transition-colors duration-300 hover:text-[#3EBA9E]">
                  Products
                </NavigationMenuTrigger>
                <NavigationMenuContent>
                  <ul className="grid w-[400px] gap-3 p-4 md:w-[500px] md:grid-cols-2 lg:w-[600px]">
                    <ListItem href="https://veezocard.com" target="_blank" title="VeezoCard">
                      Digital business card and WhatsApp store builder
                    </ListItem>
                    <ListItem href="/products/swiifta" title="Swiifta">
                      Comprehensive bill payments API
                    </ListItem>
                    <ListItem href="https://peakcv.rivqo.com" title="peakCV">
                      Create simple, professional resumes with ease
                    </ListItem>
                    <ListItem href="https://noctua.rivqo.com" title="Noctua">
                      Complete school management system
                    </ListItem>
                  </ul>
                </NavigationMenuContent>
              </NavigationMenuItem>
              <NavigationMenuItem>
                <NavigationMenuTrigger className="text-[#00664E] transition-colors duration-300 hover:text-[#3EBA9E]">
                  Services
                </NavigationMenuTrigger>
                <NavigationMenuContent>
                  <ul className="grid w-[400px] gap-3 p-4 md:w-[500px] md:grid-cols-2 lg:w-[600px]">
                    <ListItem href="/services/custom-development" title="Custom Development">
                      Tailored software solutions for your business needs
                    </ListItem>
                    <ListItem href="/services/product-design" title="Product Design">
                      User-centered design for intuitive experiences
                    </ListItem>
                    <ListItem href="/services/consulting" title="Consulting">
                      Expert advice on digital transformation
                    </ListItem>
                    <ListItem href="/services/maintenance" title="Maintenance & Support">
                      Ongoing support for your software products
                    </ListItem>
                  </ul>
                </NavigationMenuContent>
              </NavigationMenuItem>
              {/* <NavigationMenuItem className="cursor-pointer">
                <Link href="/company" legacyBehavior passHref>
                  <NavigationMenuLink
                    className={cn(
                      navigationMenuTriggerStyle(),
                      "text-[#00664E] transition-colors duration-300 hover:text-[#3EBA9E]",
                    )}
                  >
                    Company
                  </NavigationMenuLink>
                </Link>
              </NavigationMenuItem> */}
              <NavigationMenuItem className="cursor-pointer">
                <Link href="/contact" legacyBehavior passHref>
                  <NavigationMenuLink
                    className={cn(
                      navigationMenuTriggerStyle(),
                      "text-[#00664E] transition-colors duration-300 hover:text-[#3EBA9E]",
                    )}
                  >
                    Contact
                  </NavigationMenuLink>
                </Link>
              </NavigationMenuItem>
            </NavigationMenuList>
          </NavigationMenu>

          <div className="hidden md:flex">
            <Button className="bg-[#00664E] hover:bg-[#00664E]/90 relative overflow-hidden group">
              <span className="relative z-10">Book a call</span>
              <span className="absolute inset-0 bg-[#3EBA9E] transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></span>
            </Button>
          </div>

          {/* Mobile Menu Button */}
          <Button
            variant="ghost"
            size="icon"
            className="md:hidden transition-transform duration-300 active:scale-90"
            onClick={() => setIsMenuOpen(!isMenuOpen)}
          >
            {isMenuOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
            <span className="sr-only">Toggle menu</span>
          </Button>
        </div>
      </header>

      {/* Mobile Menu */}
      {isMenuOpen && (
        <div className="fixed inset-0 top-24 z-50 grid h-[calc(100vh-6rem)] grid-flow-row auto-rows-max overflow-auto p-6 pb-32 shadow-md animate-in slide-in-from-top-1 md:hidden bg-background rounded-t-3xl">
          <div className="grid gap-6 p-4">
            <Link
              href="/"
              className="flex items-center gap-2 text-lg font-semibold transition-colors duration-300 hover:text-[#3EBA9E]"
              onClick={() => setIsMenuOpen(false)}
            >
              Home
            </Link>
            <div className="grid gap-3">
              <div className="font-semibold text-[#00664E]">Products</div>
              <Link
                href="/products/veezocard"
                className="text-muted-foreground transition-colors duration-300 hover:text-[#3EBA9E]"
                onClick={() => setIsMenuOpen(false)}
              >
                VeezoCard
              </Link>
              <Link
                href="/products/swiifta"
                className="text-muted-foreground transition-colors duration-300 hover:text-[#3EBA9E]"
                onClick={() => setIsMenuOpen(false)}
              >
                Swiifta
              </Link>
              <Link
                href="/products/resume-builder"
                className="text-muted-foreground transition-colors duration-300 hover:text-[#3EBA9E]"
                onClick={() => setIsMenuOpen(false)}
              >
                peakCV
              </Link>
              <Link
                href="/products/noctua"
                className="text-muted-foreground transition-colors duration-300 hover:text-[#3EBA9E]"
                onClick={() => setIsMenuOpen(false)}
              >
                Noctua
              </Link>
            </div>
            <div className="grid gap-3">
              <div className="font-semibold text-[#00664E]">Services</div>
              <Link
                href="/services/custom-development"
                className="text-muted-foreground transition-colors duration-300 hover:text-[#3EBA9E]"
                onClick={() => setIsMenuOpen(false)}
              >
                Custom Development
              </Link>
              <Link
                href="/services/product-design"
                className="text-muted-foreground transition-colors duration-300 hover:text-[#3EBA9E]"
                onClick={() => setIsMenuOpen(false)}
              >
                Product Design
              </Link>
              <Link
                href="/services/consulting"
                className="text-muted-foreground transition-colors duration-300 hover:text-[#3EBA9E]"
                onClick={() => setIsMenuOpen(false)}
              >
                Consulting
              </Link>
              <Link
                href="/services/maintenance"
                className="text-muted-foreground transition-colors duration-300 hover:text-[#3EBA9E]"
                onClick={() => setIsMenuOpen(false)}
              >
                Maintenance & Support
              </Link>
            </div>
            <Link
              href="/company"
              className="flex items-center gap-2 text-lg font-semibold transition-colors duration-300 hover:text-[#3EBA9E]"
              onClick={() => setIsMenuOpen(false)}
            >
              Company
            </Link>
            <Link
              href="/contact"
              className="flex items-center gap-2 text-lg font-semibold transition-colors duration-300 hover:text-[#3EBA9E]"
              onClick={() => setIsMenuOpen(false)}
            >
              Contact
            </Link>
            <Button
              className="w-full bg-[#00664E] hover:bg-[#00664E]/90 relative overflow-hidden group"
              onClick={() => setIsMenuOpen(false)}
            >
              <span className="relative z-10">Book a call</span>
              <span className="absolute inset-0 bg-[#3EBA9E] transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></span>
            </Button>
          </div>
        </div>
      )}
    </div>
  )
}

const ListItem = React.forwardRef<React.ElementRef<"a">, React.ComponentPropsWithoutRef<"a">>(
  ({ className, title, children, ...props }, ref) => {
    return (
      <li>
        <NavigationMenuLink asChild>
          <a
            ref={ref}
            className={cn(
              "block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground",
              className,
            )}
            {...props}
          >
            <div className="text-sm font-medium leading-none text-[#00664E]">{title}</div>
            <p className="line-clamp-2 text-sm leading-snug text-muted-foreground">{children}</p>
          </a>
        </NavigationMenuLink>
      </li>
    )
  },
)
ListItem.displayName = "ListItem"
