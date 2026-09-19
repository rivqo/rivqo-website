"use server";

import { headers } from "next/headers";
import {
  handleEnquiry,
  type EnquiryActionResult,
} from "@/lib/enquiry/handle-enquiry";

function readField(formData: FormData, name: string) {
  const value = formData.get(name);
  return typeof value === "string" ? value : "";
}

export async function submitEnquiryAction(
  formData: FormData,
): Promise<EnquiryActionResult> {
  const headerList = await headers();
  const forwarded = headerList.get("x-forwarded-for");
  const clientKey =
    forwarded?.split(",")[0]?.trim() ||
    headerList.get("x-real-ip") ||
    "anonymous";

  return handleEnquiry(
    {
      name: readField(formData, "name"),
      email: readField(formData, "email"),
      company: readField(formData, "company"),
      role: readField(formData, "role"),
      industry: readField(formData, "industry"),
      challenge: readField(formData, "challenge"),
      message: readField(formData, "message"),
      website: readField(formData, "website"),
      startedAt: readField(formData, "startedAt"),
    },
    {
      origin: headerList.get("origin"),
      host: headerList.get("host"),
      clientKey,
    },
  );
}
