<?php

declare(strict_types=1);

namespace App\Provider;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class SessionProvider
{
    public static function getSession(RequestStack|SessionInterface $requestStackOrSession): SessionInterface
    {
        if ($requestStackOrSession instanceof SessionInterface) {
            return $requestStackOrSession;
        }

        return $requestStackOrSession->getSession();
    }
}