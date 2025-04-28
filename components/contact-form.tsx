"use client"

import type React from "react"

import { useState } from "react"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Textarea } from "@/components/ui/textarea"
import { Label } from "@/components/ui/label"
import { Send } from "lucide-react"

export default function ContactForm() {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    subject: "",
    message: "",
  })

  const [isSubmitting, setIsSubmitting] = useState(false)
  const [isSubmitted, setIsSubmitted] = useState(false)

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target
    setFormData((prev) => ({ ...prev, [name]: value }))
  }

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    setIsSubmitting(true)

    // Simulate form submission
    await new Promise((resolve) => setTimeout(resolve, 1500))

    setIsSubmitting(false)
    setIsSubmitted(true)
    setFormData({ name: "", email: "", subject: "", message: "" })

    // Reset success message after 5 seconds
    setTimeout(() => {
      setIsSubmitted(false)
    }, 5000)
  }

  return (
    <form onSubmit={handleSubmit} className="space-y-6">
      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div className="space-y-2 transition-all duration-300 focus-within:scale-[1.02]">
          <Label htmlFor="name">Name</Label>
          <Input
            id="name"
            name="name"
            placeholder="Your name"
            value={formData.name}
            onChange={handleChange}
            required
            className="border-gray-300 focus:border-[#3EBA9E] focus:ring-[#3EBA9E] transition-all duration-300"
          />
        </div>
        <div className="space-y-2 transition-all duration-300 focus-within:scale-[1.02]">
          <Label htmlFor="email">Email</Label>
          <Input
            id="email"
            name="email"
            type="email"
            placeholder="Your email"
            value={formData.email}
            onChange={handleChange}
            required
            className="border-gray-300 focus:border-[#3EBA9E] focus:ring-[#3EBA9E] transition-all duration-300"
          />
        </div>
      </div>
      <div className="space-y-2 transition-all duration-300 focus-within:scale-[1.02]">
        <Label htmlFor="subject">Subject</Label>
        <Input
          id="subject"
          name="subject"
          placeholder="Subject"
          value={formData.subject}
          onChange={handleChange}
          required
          className="border-gray-300 focus:border-[#3EBA9E] focus:ring-[#3EBA9E] transition-all duration-300"
        />
      </div>
      <div className="space-y-2 transition-all duration-300 focus-within:scale-[1.02]">
        <Label htmlFor="message">Message</Label>
        <Textarea
          id="message"
          name="message"
          placeholder="Your message"
          value={formData.message}
          onChange={handleChange}
          required
          className="min-h-[150px] border-gray-300 focus:border-[#3EBA9E] focus:ring-[#3EBA9E] transition-all duration-300"
        />
      </div>
      <Button
        type="submit"
        className="w-full bg-[#00664E] hover:bg-[#00664E]/90 relative overflow-hidden group"
        disabled={isSubmitting}
      >
        {isSubmitting ? (
          <span className="flex items-center gap-2">
            <svg
              className="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
            >
              <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
              <path
                className="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
              ></path>
            </svg>
            Sending...
          </span>
        ) : (
          <span className="flex items-center gap-2 relative z-10">
            Send Message
            <Send className="h-4 w-4 transition-transform group-hover:translate-x-1" />
          </span>
        )}
        <span className="absolute inset-0 bg-[#3EBA9E] transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></span>
      </Button>

      {isSubmitted && (
        <div className="p-4 bg-green-50 text-green-700 rounded-md text-center animate-fadeIn">
          Thank you for your message! We'll get back to you soon.
        </div>
      )}
    </form>
  )
}
