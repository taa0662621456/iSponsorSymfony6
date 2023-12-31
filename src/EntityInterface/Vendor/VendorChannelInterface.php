<?php

namespace App\EntityInterface\Vendor;

interface VendorChannelInterface
{
    public function setDefaultTaxZone(mixed $default_tax_zone);

    public function setTaxCalculationStrategy(mixed $tax_calculation_strategy);

    public function setThemeName(mixed $theme_name);

    public function setContactEmail(mixed $contact_email);

    public function setContactPhoneNumber(mixed $contact_phone_number);

    public function setSkippingShippingStepAllowed(mixed $skipping_shipping_step_allowed);

    public function setSkippingPaymentStepAllowed(mixed $skipping_payment_step_allowed);

    public function setAccountVerificationRequired(mixed $account_verification_required);

    public function setMenuTaxon(mixed $menu_taxon);
}
