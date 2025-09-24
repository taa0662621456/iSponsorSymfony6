<?php

namespace App\Event;

use App\Entity\Event\Event;

class EmailEvent extends Event
{
    public const EMAIL_RESET_PASSWORD_TOKEN = 'email.reset_password_token';

    public const EMAIL_RESET_PASSWORD_PIN = 'email.reset_password_pin';

    public const EMAIL_VERIFICATION_TOKEN = 'email.verification_token';

}