import { escapeHtml, plainLine } from "@/lib/enquiry/escape";
import {
  enquiryChallenges,
  enquiryIndustries,
  enquiryRoles,
} from "@/data/homepage";
import type { EnquiryFields } from "@/lib/enquiry/schema";
import { site } from "@/data/site";

export type EnquiryMail = {
  to: string;
  from: string;
  replyTo: string;
  subject: string;
  text: string;
  html: string;
};

export type EnquiryMailer = {
  send: (mail: EnquiryMail) => Promise<{ accepted: boolean }>;
};

function labelFor(
  options: ReadonlyArray<{ value: string; label: string }>,
  value: string,
) {
  return options.find((option) => option.value === value)?.label ?? value;
}

export function buildEnquiryMail(
  fields: EnquiryFields,
  sentAt: Date,
): EnquiryMail {
  const company = plainLine(fields.company);
  const subject = company
    ? `New Rivqo enquiry — ${company}`
    : "New Rivqo website enquiry";
  const role = labelFor(enquiryRoles, fields.role);
  const industry = labelFor(enquiryIndustries, fields.industry);
  const challenge = labelFor(enquiryChallenges, fields.challenge);
  const message = plainLine(fields.message) || "None";
  const timestamp = sentAt.toISOString();

  const text = [
    "New website enquiry",
    "",
    `Name: ${plainLine(fields.name)}`,
    `Work email: ${plainLine(fields.email)}`,
    `Company: ${company}`,
    `Role: ${role}`,
    `Industry: ${industry}`,
    `Primary operational challenge: ${challenge}`,
    `Optional message: ${message}`,
    `Submitted: ${timestamp}`,
    `Source: ${site.url}`,
  ].join("\n");

  const html = `
    <h1>New website enquiry</h1>
    <p><strong>Name:</strong> ${escapeHtml(plainLine(fields.name))}</p>
    <p><strong>Work email:</strong> ${escapeHtml(plainLine(fields.email))}</p>
    <p><strong>Company:</strong> ${escapeHtml(company)}</p>
    <p><strong>Role:</strong> ${escapeHtml(role)}</p>
    <p><strong>Industry:</strong> ${escapeHtml(industry)}</p>
    <p><strong>Primary operational challenge:</strong> ${escapeHtml(challenge)}</p>
    <p><strong>Optional message:</strong></p>
    <p>${escapeHtml(message).replaceAll("\n", "<br />")}</p>
    <p><strong>Submitted:</strong> ${escapeHtml(timestamp)}</p>
    <p><strong>Source:</strong> ${escapeHtml(site.url)}</p>
  `.trim();

  const to = process.env.ENQUIRY_TO_EMAIL ?? site.contact.email ?? "";
  const from = process.env.ENQUIRY_FROM_EMAIL ?? "";

  return {
    to,
    from,
    replyTo: plainLine(fields.email),
    subject,
    text,
    html,
  };
}
