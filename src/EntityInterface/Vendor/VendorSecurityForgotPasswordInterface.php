<?php

namespace App\EntityInterface\Vendor;

interface VendorSecurityForgotPasswordInterface
{
    public function updatePassword(VendorCredentialInterface $vendor): void;
}