<?php

namespace App\Service\Vendor;

use App\Entity\Vendor\SecurityApiToken;
use App\Repository\Vendor\SecurityApiTokenRepository;
use Symfony\Component\HttpFoundation\Request;

class VendorApiTokenManager
{
    public function __construct(
        private readonly SecurityApiTokenRepository $tokenRepository
    ) {}

    public function validateToken(string $tokenValue, Request $request): ?SecurityApiToken
    {
        $token = $this->tokenRepository->findValidToken($tokenValue);

        if (!$token) {
            return null;
        }

        // Проверка IP
        if (!$token->isIpAllowed($request->getClientIp() ?? '')) {
            return null;
        }

        return $token;
    }

    public function validateScope(SecurityApiToken $token, string $scope): bool
    {
        return $token->hasScope($scope);
    }
}
