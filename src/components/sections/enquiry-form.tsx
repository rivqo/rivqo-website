"use client";

import { useEffect, useId, useRef, useState } from "react";
import Link from "next/link";
import { usePathname } from "next/navigation";
import { submitEnquiryAction } from "@/app/actions/submit-enquiry";
import { Button } from "@/components/ui/button";
import {
  enquiryChallenges,
  enquiryIndustries,
  enquiryRoles,
} from "@/data/homepage";
import { track } from "@/lib/analytics/track";
import { enquiryMailto } from "@/lib/contact";
import { enquiryCopy } from "@/lib/enquiry/copy";

type EnquiryFormProps = {
  contactEmail: string;
  deliveryEnabled?: boolean;
};

type FormValues = {
  name: string;
  email: string;
  company: string;
  role: string;
  industry: string;
  challenge: string;
  message: string;
};

type FieldErrors = Partial<Record<keyof FormValues, string>>;

type FormStatus =
  | "idle"
  | "validating"
  | "submitting"
  | "success"
  | "validation_error"
  | "delivery_failed"
  | "rate_limited";

const emptyForm: FormValues = {
  name: "",
  email: "",
  company: "",
  role: "",
  industry: "",
  challenge: "",
  message: "",
};

function validate(values: FormValues): FieldErrors {
  const errors: FieldErrors = {};

  if (values.name.trim().length < 2) {
    errors.name = "Enter your full name.";
  }

  if (!values.email.trim()) {
    errors.email = "Enter a work email address.";
  } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(values.email)) {
    errors.email = "Enter a valid email address.";
  }

  if (values.company.trim().length < 2) {
    errors.company = "Enter your company name.";
  }

  if (!values.role) {
    errors.role = "Select your role.";
  }

  if (!values.industry) {
    errors.industry = "Select an industry.";
  }

  if (!values.challenge) {
    errors.challenge = "Select the primary operational challenge.";
  }

  return errors;
}

export function EnquiryForm({
  contactEmail,
  deliveryEnabled = false,
}: EnquiryFormProps) {
  const formId = useId();
  const pathname = usePathname();
  const mailto = enquiryMailto();
  const statusRef = useRef<HTMLDivElement>(null);
  const startedRef = useRef(false);
  const [values, setValues] = useState<FormValues>(emptyForm);
  const [errors, setErrors] = useState<FieldErrors>({});
  const [status, setStatus] = useState<FormStatus>("idle");
  const [notice, setNotice] = useState<string | null>(null);
  const [startedAt] = useState(() => Date.now());

  function update<K extends keyof FormValues>(field: K, value: FormValues[K]) {
    if (!startedRef.current) {
      startedRef.current = true;
      track("enquiry_started", { pathname });
    }

    setValues((current) => ({ ...current, [field]: value }));
  }

  useEffect(() => {
    if (
      status === "success" ||
      status === "delivery_failed" ||
      status === "rate_limited"
    ) {
      statusRef.current?.focus();
    }
  }, [status]);

  async function onSubmit(event: React.FormEvent<HTMLFormElement>) {
    event.preventDefault();
    if (status === "submitting") {
      return;
    }

    setStatus("validating");
    const nextErrors = validate(values);
    setErrors(nextErrors);

    if (Object.keys(nextErrors).length > 0) {
      setStatus("validation_error");
      setNotice(enquiryCopy.invalid);
      track("enquiry_validation_failed", {
        pathname,
        industry: values.industry || "none",
        challenge: values.challenge || "none",
      });
      const firstError = Object.keys(nextErrors)[0];
      document.getElementById(`${formId}-${firstError}`)?.focus();
      return;
    }

    setStatus("submitting");
    setNotice(null);

    const formData = new FormData(event.currentTarget);
    const result = await submitEnquiryAction(formData);

    if (result.status === "success" && deliveryEnabled) {
      setValues(emptyForm);
      setErrors({});
      setStatus("success");
      setNotice(result.message);
      track("enquiry_submitted", {
        pathname,
        industry: values.industry,
        challenge: values.challenge,
      });
      return;
    }

    if (result.status === "success") {
      setStatus("delivery_failed");
      setNotice(enquiryCopy.unavailable);
      track("enquiry_delivery_failed", {
        pathname,
        reason: "delivery_disabled",
      });
      return;
    }

    if (result.status === "invalid") {
      setStatus("validation_error");
      setErrors(result.fieldErrors ?? nextErrors);
      setNotice(result.message);
      track("enquiry_validation_failed", {
        pathname,
        industry: values.industry || "none",
        challenge: values.challenge || "none",
      });
      return;
    }

    if (result.status === "rate_limited") {
      setStatus("rate_limited");
      setNotice(result.message);
      track("enquiry_delivery_failed", {
        pathname,
        reason: "rate_limited",
      });
      return;
    }

    setStatus("delivery_failed");
    setNotice(result.message);
    track("enquiry_delivery_failed", { pathname, reason: "delivery" });
  }

  const pending = status === "submitting" || status === "validating";
  return (
    <form
      id="enquiry-form"
      className="grid gap-4"
      noValidate
      onSubmit={onSubmit}
    >
      <p className="text-sm text-muted-foreground">
        {deliveryEnabled ? enquiryCopy.privacy : enquiryCopy.unavailable}{" "}
        <Link href="/privacy" className="underline underline-offset-2">
          See our Privacy Notice
        </Link>
        .
      </p>

      <div className="hp-field" aria-hidden="true">
        <label htmlFor={`${formId}-website`}>Website</label>
        <input
          id={`${formId}-website`}
          name="website"
          type="text"
          tabIndex={-1}
          autoComplete="off"
        />
      </div>
      <input type="hidden" name="startedAt" value={String(startedAt)} />

      <div>
        <label className="field-label" htmlFor={`${formId}-name`}>
          Full name <span aria-hidden="true">*</span>
        </label>
        <input
          id={`${formId}-name`}
          name="name"
          type="text"
          autoComplete="name"
          autoCapitalize="words"
          required
          aria-required="true"
          maxLength={100}
          className="field-input"
          value={values.name}
          aria-invalid={Boolean(errors.name)}
          aria-describedby={errors.name ? `${formId}-name-error` : undefined}
          onChange={(event) => update("name", event.target.value)}
        />
        {errors.name ? (
          <span id={`${formId}-name-error`} className="field-error">
            {errors.name}
          </span>
        ) : null}
      </div>

      <div>
        <label className="field-label" htmlFor={`${formId}-email`}>
          Work email <span aria-hidden="true">*</span>
        </label>
        <input
          id={`${formId}-email`}
          name="email"
          type="email"
          autoComplete="email"
          inputMode="email"
          required
          aria-required="true"
          maxLength={254}
          className="field-input"
          value={values.email}
          aria-invalid={Boolean(errors.email)}
          aria-describedby={errors.email ? `${formId}-email-error` : undefined}
          onChange={(event) => update("email", event.target.value)}
        />
        {errors.email ? (
          <span id={`${formId}-email-error`} className="field-error">
            {errors.email}
          </span>
        ) : null}
      </div>

      <div>
        <label className="field-label" htmlFor={`${formId}-company`}>
          Company <span aria-hidden="true">*</span>
        </label>
        <input
          id={`${formId}-company`}
          name="company"
          type="text"
          autoComplete="organization"
          required
          aria-required="true"
          maxLength={150}
          className="field-input"
          value={values.company}
          aria-invalid={Boolean(errors.company)}
          aria-describedby={
            errors.company ? `${formId}-company-error` : undefined
          }
          onChange={(event) => update("company", event.target.value)}
        />
        {errors.company ? (
          <span id={`${formId}-company-error`} className="field-error">
            {errors.company}
          </span>
        ) : null}
      </div>

      <div>
        <label className="field-label" htmlFor={`${formId}-role`}>
          Role <span aria-hidden="true">*</span>
        </label>
        <select
          id={`${formId}-role`}
          name="role"
          autoComplete="organization-title"
          required
          aria-required="true"
          className="field-input"
          value={values.role}
          aria-invalid={Boolean(errors.role)}
          aria-describedby={errors.role ? `${formId}-role-error` : undefined}
          onChange={(event) => update("role", event.target.value)}
        >
          <option value="">Select a role</option>
          {enquiryRoles.map((option) => (
            <option key={option.value} value={option.value}>
              {option.label}
            </option>
          ))}
        </select>
        {errors.role ? (
          <span id={`${formId}-role-error`} className="field-error">
            {errors.role}
          </span>
        ) : null}
      </div>

      <div>
        <label className="field-label" htmlFor={`${formId}-industry`}>
          Industry <span aria-hidden="true">*</span>
        </label>
        <select
          id={`${formId}-industry`}
          name="industry"
          required
          aria-required="true"
          className="field-input"
          value={values.industry}
          aria-invalid={Boolean(errors.industry)}
          aria-describedby={
            errors.industry ? `${formId}-industry-error` : undefined
          }
          onChange={(event) => update("industry", event.target.value)}
        >
          <option value="">Select an industry</option>
          {enquiryIndustries.map((option) => (
            <option key={option.value} value={option.value}>
              {option.label}
            </option>
          ))}
        </select>
        {errors.industry ? (
          <span id={`${formId}-industry-error`} className="field-error">
            {errors.industry}
          </span>
        ) : null}
      </div>

      <div>
        <label className="field-label" htmlFor={`${formId}-challenge`}>
          Primary operational challenge <span aria-hidden="true">*</span>
        </label>
        <select
          id={`${formId}-challenge`}
          name="challenge"
          required
          aria-required="true"
          className="field-input"
          value={values.challenge}
          aria-invalid={Boolean(errors.challenge)}
          aria-describedby={
            errors.challenge ? `${formId}-challenge-error` : undefined
          }
          onChange={(event) => update("challenge", event.target.value)}
        >
          <option value="">Select a challenge</option>
          {enquiryChallenges.map((option) => (
            <option key={option.value} value={option.value}>
              {option.label}
            </option>
          ))}
        </select>
        {errors.challenge ? (
          <span id={`${formId}-challenge-error`} className="field-error">
            {errors.challenge}
          </span>
        ) : null}
      </div>

      <div>
        <label className="field-label" htmlFor={`${formId}-message`}>
          Optional message
        </label>
        <textarea
          id={`${formId}-message`}
          name="message"
          rows={4}
          maxLength={2000}
          className="field-input min-h-28"
          value={values.message}
          onChange={(event) => update("message", event.target.value)}
        />
      </div>

      <div className="pt-2">
        {deliveryEnabled ? (
          <Button type="submit" disabled={pending || status === "success"}>
            {pending ? "Sending enquiry" : "Start a conversation"}
          </Button>
        ) : (
          <Button href={mailto} data-cta="contact-email">
            Email {contactEmail}
          </Button>
        )}
      </div>

      {notice ? (
        <div
          ref={statusRef}
          tabIndex={-1}
          role={status === "success" ? "status" : "alert"}
          className="border border-border bg-muted px-4 py-3"
        >
          <p>{notice}</p>
          {status !== "success" ? (
            <p className="mt-2">
              Or email{" "}
              <a href={mailto} className="underline underline-offset-2">
                {contactEmail}
              </a>{" "}
              directly.
            </p>
          ) : (
            <p className="mt-2">
              You can also reach Rivqo at{" "}
              <a href={mailto} className="underline underline-offset-2">
                {contactEmail}
              </a>
              .
            </p>
          )}
        </div>
      ) : (
        <p className="text-sm text-muted-foreground">
          Prefer email? Write to{" "}
          <a href={mailto} className="underline underline-offset-2">
            {contactEmail}
          </a>
          .
        </p>
      )}
    </form>
  );
}
