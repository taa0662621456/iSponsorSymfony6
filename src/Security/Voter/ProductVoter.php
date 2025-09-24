<?php

namespace App\Security\Voter;

use App\Entity\Product\Product;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class ProductVoter extends Voter
{
    public const EDIT = 'PRODUCT_EDIT';
    public const VIEW = 'PRODUCT_VIEW';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof Product && in_array($attribute, [self::EDIT, self::VIEW], true);
    }

    protected function voteOnAttribute(string $attribute, mixed $product, \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!is_object($user)) return false;

        $isVendorOwner = $product->getVendor()?->getUser()?->getId() === $user->getId();
        $isAdmin = in_array('ROLE_ADMIN', $user->getRoles(), true) || in_array('ROLE_MANAGER', $user->getRoles(), true);

        return match ($attribute) {
            self::VIEW => true, // каталог публичный (если у тебя иначе — поменяй)
            self::EDIT => $isVendorOwner || $isAdmin,
        };
    }
}