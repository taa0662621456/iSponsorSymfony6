<?php

namespace App\Service\Vendor;

use App\Entity\Vendor\Vendor;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class VendorVoter extends Voter
{
    public const MANAGE = 'VENDOR_MANAGE';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $attribute === self::MANAGE && ($subject instanceof Vendor || is_object($subject));
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!is_object($user)) return false;

        $isAdmin = in_array('ROLE_ADMIN', $user->getRoles(), true) || in_array('ROLE_MANAGER', $user->getRoles(), true);
        $vendor = $subject instanceof Vendor ? $subject : ($user->getVendor() ?? null);

        return $isAdmin || ($vendor && $vendor->getUser()?->getId() === $user->getId());
    }
}
