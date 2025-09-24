<?php

namespace App\Security\Voter;

use App\Entity\Order\Order;
use App\Entity\User;
use App\Enum\OrderPermission;
use App\Security\OrderPermissionProvider;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class OrderVoter extends Voter
{
    public function __construct(private readonly OrderPermissionProvider $provider) {}

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $subject instanceof Order
            && in_array($attribute, array_column(OrderPermission::cases(), 'value'), true);
    }

    protected function voteOnAttribute(string $attribute, mixed $order, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }

        $permissions = $this->provider->getPermissionsForRoles($user->getRoles());

        if (!in_array($attribute, $permissions, true)) {
            return false;
        }

        // бизнес-правила
        return match ($attribute) {
            OrderPermission::CANCEL->value => $order->isCancellable() && $this->isOwnerOrVendorOrManager($order, $user),
            OrderPermission::REFUND->value => $order->isRefundable() && $this->isVendorOrManager($order, $user),
            OrderPermission::PAY->value    => $order->isPayable() && $this->isOwner($order, $user),
            default                        => $this->isOwner($order, $user) || $this->isVendorOrManager($order, $user),
        };
    }

    private function isOwner(Order $order, User $user): bool
    {
        return $order->getCustomer()?->getId() === $user->getId();
    }

    private function isVendorOrManager(Order $order, User $user): bool
    {
        return $order->getVendor()?->getUser()?->getId() === $user->getId()
            || in_array('ROLE_MANAGER', $user->getRoles(), true);
    }

    private function isOwnerOrVendorOrManager(Order $order, User $user): bool
    {
        return $this->isOwner($order, $user) || $this->isVendorOrManager($order, $user);
    }
}
