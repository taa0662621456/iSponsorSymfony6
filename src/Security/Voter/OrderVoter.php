<?php

namespace App\Security\Voter;

use App\Entity\Order\OrderStorage;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class OrderVoter extends Voter
{
    public const VIEW   = 'ORDER_VIEW';
    public const EDIT   = 'ORDER_EDIT';
    public const CANCEL = 'ORDER_CANCEL';
    public const REFUND = 'ORDER_REFUND';
    public const PAY    = 'ORDER_PAY';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof OrderStorage && in_array($attribute, [
                self::VIEW, self::EDIT, self::CANCEL, self::REFUND, self::PAY
            ], true);
    }

    protected function voteOnAttribute(string $attribute, mixed $order, \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!is_object($user)) return false;

        $isOwner = method_exists($order, 'getCustomer') && $order->getCustomer()?->getUser()?->getId() === $user->getId();
        $isVendor = method_exists($order, 'getVendor') && $order->getVendor()?->getUser()?->getId() === $user->getId();
        $isAdmin = in_array('ROLE_ADMIN', $user->getRoles(), true) || in_array('ROLE_MANAGER', $user->getRoles(), true);

        return match ($attribute) {
            self::VIEW   => $isOwner || $isVendor || $isAdmin,
            self::EDIT   => $isVendor || $isAdmin,
            self::CANCEL => ($isOwner || $isVendor || $isAdmin) && $order->isCancellable(),
            self::REFUND => ($isVendor || $isAdmin) && $order->isRefundable(),
            self::PAY    => $isOwner && $order->isPayable(),
        };
    }
}
