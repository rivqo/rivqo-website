export function enquiryDeliveryEnabled() {
  return (
    process.env.ENQUIRY_DELIVERY_ENABLED === "true" &&
    Boolean(process.env.RESEND_API_KEY) &&
    Boolean(process.env.ENQUIRY_FROM_EMAIL)
  );
}
