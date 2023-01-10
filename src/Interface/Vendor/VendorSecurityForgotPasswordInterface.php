<?php

namespace App\Interface\Vendor;

interface VendorSecurityForgotPasswordInterface
{
    public function updatePassword(VendorCredentialInterface $vendor): void;

}
