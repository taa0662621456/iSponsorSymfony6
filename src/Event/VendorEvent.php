<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class VendorEvent extends Event
{
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    public const VENDOR_EMAIL_CONFIRMED = 'vendor.email_confirmed';

    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    public const VENDOR_REQUEST_VERIFICATION_TOKEN = 'vendor.request_token';

    public const VENDOR_REQUEST_RESET_PASSWORD_TOKEN = 'vendor.password_reset.request.token';

    public const VENDOR_REQUEST_RESET_PASSWORD_PIN = 'vendor.password_reset.request.pin';

    public const VENDOR_PRE_EMAIL_VERIFICATION = 'vendor.pre_email_verification';

    public const VENDOR_POST_EMAIL_VERIFICATION = 'vendor.post_email_verification';

    public const VENDOR_PRE_PASSWORD_RESET = 'vendor.pre_password_reset';

    public const VENDOR_POST_PASSWORD_RESET = 'vendor.post_password_reset';

    public const VENDOR_PRE_PASSWORD_CHANGE = 'vendor.pre_password_change';

    public const VENDOR_POST_PASSWORD_CHANGE = 'vendor.post_password_change';

    public const VENDOR_SECURITY_IMPERSONATE = 'vendor.security.impersonate';

    /**
     * Occurs when the user is logged in programmatically.
     */
    public const VENDOR_SECURITY_IMPLICIT_LOGIN = 'vendor.security.implicit_login';
}
