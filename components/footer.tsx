import Link from "next/link"
import Image from "next/image"
import { Facebook, Twitter, Instagram, Linkedin, Mail, Phone } from "lucide-react"

export default function Footer() {
  return (
    <footer className="bg-gray-50">
      <div className="container px-4 md:px-6 py-12 md:py-16">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div className="space-y-4">
            <Link href="/" className="flex items-center gap-2">
              <Image src="/images/rivqo-logo.png" alt="Rivqo Logo" width={100} height={40} />
            </Link>
            <p className="text-sm text-gray-500">
              Building impactful software for African growth. We create innovative solutions that empower businesses and
              individuals.
            </p>
            <div className="flex space-x-4">
              <Link
                href="#"
                className="text-gray-500 hover:text-[#00664E] bg-[#00664E]/5 px-3 py-1 rounded-md transition-colors"
              >
                <Facebook className="h-5 w-5" />
                <span className="sr-only">Facebook</span>
              </Link>
              <Link
                href="#"
                className="text-gray-500 hover:text-[#00664E] bg-[#00664E]/5 px-3 py-1 rounded-md transition-colors"
              >
                <Twitter className="h-5 w-5" />
                <span className="sr-only">Twitter</span>
              </Link>
              <Link
                href="#"
                className="text-gray-500 hover:text-[#00664E] bg-[#00664E]/5 px-3 py-1 rounded-md transition-colors"
              >
                <Instagram className="h-5 w-5" />
                <span className="sr-only">Instagram</span>
              </Link>
              <Link
                href="#"
                className="text-gray-500 hover:text-[#00664E] bg-[#00664E]/5 px-3 py-1 rounded-md transition-colors"
              >
                <Linkedin className="h-5 w-5" />
                <span className="sr-only">LinkedIn</span>
              </Link>
            </div>
          </div>
          <div className="space-y-4">
            <h3 className="text-lg font-semibold text-[#00664E]">Products</h3>
            <ul className="space-y-2">
              <li>
                <Link
                  href="https://veezocard.com"
                  className="text-gray-500 hover:text-[#00664E]  py-1 rounded-md transition-colors"
                >
                  VeezoCard
                </Link>
              </li>
              <li>
                <Link
                  href="/products/swiifta"
                  className="text-gray-500 hover:text-[#00664E]  py-1 rounded-md transition-colors"
                >
                  Swiifta
                </Link>
              </li>
              <li>
                <Link
                  href="https://peakcv.rivqo.com"
                  className="text-gray-500 hover:text-[#00664E]  py-1 rounded-md transition-colors"
                >
                  peakCV
                </Link>
              </li>
              <li>
                <Link
                  href="https://noctua.rivqo.com"
                  className="text-gray-500 hover:text-[#00664E]  py-1 rounded-md transition-colors"
                >
                  Noctua
                </Link>
              </li>
            </ul>
          </div>
          <div className="space-y-4">
            <h3 className="text-lg font-semibold text-[#00664E]">Company</h3>
            <ul className="space-y-2">
              <li>
                <Link
                  href="/company/about"
                  className="text-gray-500 hover:text-[#00664E]  py-1 rounded-md transition-colors"
                >
                  About Us
                </Link>
              </li>
              <li>
                <Link
                  href="/company/team"
                  className="text-gray-500 hover:text-[#00664E]  py-1 rounded-md transition-colors"
                >
                  Our Team
                </Link>
              </li>
              <li>
                <Link
                  href="/company/careers"
                  className="text-gray-500 hover:text-[#00664E]  py-1 rounded-md transition-colors"
                >
                  Careers
                </Link>
              </li>
              <li>
                <Link
                  href="/contact"
                  className="text-gray-500 hover:text-[#00664E]  py-1 rounded-md transition-colors"
                >
                  Contact Us
                </Link>
              </li>
            </ul>
          </div>
          <div className="space-y-4">
            <h3 className="text-lg font-semibold text-[#00664E]">Contact</h3>
            <ul className="space-y-2">
              <li className="flex items-center gap-2">
                <Mail className="h-4 w-4 text-[#3EBA9E]" />
                <a
                  href="mailto:info@rivqo.com"
                  className="text-gray-500 hover:text-[#00664E]  py-1 rounded-md transition-colors"
                >
                  ola@rivqo.com
                </a>
              </li>
              <li className="flex items-center gap-2">
                <Phone className="h-4 w-4 text-[#3EBA9E]" />
                <a
                  href="tel:+2341234567890"
                  className="text-gray-500 hover:text-[#00664E]  py-1 rounded-md transition-colors"
                >
                  +234 901 725 7294
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div className="mt-12 pt-8 border-t border-gray-200">
          <div className="flex flex-col md:flex-row justify-between items-center gap-4">
            <p className="text-sm text-gray-500">© {new Date().getFullYear()} Rivqo Digital LTD. All rights reserved.</p>
            <div className="flex space-x-6">
              <Link
                href="/privacy"
                className="text-sm text-gray-500 hover:text-[#00664E]  py-1 rounded-md transition-colors"
              >
                Privacy Policy
              </Link>
              <Link
                href="/terms"
                className="text-sm text-gray-500 hover:text-[#00664E]  py-1 rounded-md transition-colors"
              >
                Terms of Service
              </Link>
            </div>
          </div>
        </div>
      </div>
    </footer>
  )
}
