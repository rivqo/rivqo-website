import ContactForm from "@/components/contact-form"
import MinimalistPattern from "@/components/minimalist-pattern"
import { Mail, MapPin, Phone } from "lucide-react"

export default function ContactPage() {
  return (
    <div className="flex flex-col min-h-screen">
      <main className="flex-1">
        {/* Hero Section */}
        <section className="relative w-full py-20 md:py-32 overflow-hidden">
          <div className="absolute inset-0 bg-gradient-to-br from-[#00664E] to-[#3EBA9E] opacity-90"></div>
          <MinimalistPattern className="absolute inset-0 opacity-10" />
          <div className="container relative px-4 md:px-6 z-10">
            <div className="flex flex-col mt-20 md:mt-10 items-center justify-center text-center max-w-3xl mx-auto space-y-4">
              <h1 className="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-white">Get in Touch</h1>
              <p className="max-w-[600px] text-white/90 md:text-xl">
                Have questions about our products or services? We'd love to hear from you.
              </p>
            </div>
          </div>
        </section>

        {/* Contact Information */}
        <section className="relative w-full py-20 md:py-32">
          <MinimalistPattern className="absolute inset-0 opacity-5" />
          <div className="container relative px-4 md:px-6 z-10">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-12">
              <div className="space-y-8">
                <div>
                  <h2 className="text-2xl font-bold text-[#00664E] mb-4">Contact Information</h2>
                  <p className="text-gray-600">
                    Reach out to us with any questions or inquiries. We're here to help and would love to hear from you.
                  </p>
                </div>

                <div className="space-y-4">
                  <div className="flex items-start gap-4">
                    <div className="bg-[#3EBA9E]/10 p-3 rounded-full">
                      <Mail className="h-6 w-6 text-[#00664E]" />
                    </div>
                    <div>
                      <h3 className="font-medium text-[#00664E]">Email</h3>
                      <p className="text-gray-600">info@rivqo.com</p>
                      <p className="text-gray-600">support@rivqo.com</p>
                    </div>
                  </div>

                  <div className="flex items-start gap-4">
                    <div className="bg-[#3EBA9E]/10 p-3 rounded-full">
                      <Phone className="h-6 w-6 text-[#00664E]" />
                    </div>
                    <div>
                      <h3 className="font-medium text-[#00664E]">Phone</h3>
                      <p className="text-gray-600">+234 123 456 7890</p>
                      <p className="text-gray-600">+234 987 654 3210</p>
                    </div>
                  </div>

                  <div className="flex items-start gap-4">
                    <div className="bg-[#3EBA9E]/10 p-3 rounded-full">
                      <MapPin className="h-6 w-6 text-[#00664E]" />
                    </div>
                    <div>
                      <h3 className="font-medium text-[#00664E]">Office</h3>
                      <p className="text-gray-600">123 Innovation Drive</p>
                      <p className="text-gray-600">Lagos, Nigeria</p>
                    </div>
                  </div>
                </div>

                <div className="pt-8 border-t border-gray-200">
                  <h3 className="text-xl font-medium text-[#00664E] mb-4">Business Hours</h3>
                  <div className="space-y-2">
                    <div className="flex justify-between">
                      <span className="text-gray-600">Monday - Friday:</span>
                      <span className="text-gray-600">9:00 AM - 6:00 PM</span>
                    </div>
                    <div className="flex justify-between">
                      <span className="text-gray-600">Saturday:</span>
                      <span className="text-gray-600">10:00 AM - 2:00 PM</span>
                    </div>
                    <div className="flex justify-between">
                      <span className="text-gray-600">Sunday:</span>
                      <span className="text-gray-600">Closed</span>
                    </div>
                  </div>
                </div>
              </div>

              <div className="bg-white rounded-lg shadow-lg p-8">
                <h2 className="text-2xl font-bold text-[#00664E] mb-6">Send us a Message</h2>
                <ContactForm />
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>
  )
}
