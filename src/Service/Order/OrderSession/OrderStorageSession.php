<?php

namespace App\Service\Order\OrderSession;

use App\EntityInterface\Order\OrderStorageInterface;
use App\EntityInterface\Vendor\VendorInterface;
use App\Provider\SessionProvider;
use App\Repository\Order\OrderRepository;
use App\ServiceInterface\Cart\CartSessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class OrderStorageSession implements CartSessionInterface
{
    public function __construct(
        private readonly RequestStack|SessionInterface $requestStackOrSession,
        private readonly string $sessionKeyName,
        private readonly OrderRepository $orderRepository,
    ) {
        if ($requestStackOrSession instanceof SessionInterface) {
            trigger_deprecation('sylius/core-bundle', '1.12', sprintf('Passing an instance of %s as constructor argument for %s is deprecated as of Sylius 1.12 and will be removed in 2.0. Pass an instance of %s instead.', SessionInterface::class, self::class, RequestStack::class));
        }
    }

    public function hasForVendor(VendorInterface $vendor): bool
    {
        return SessionProvider::getSession($this->requestStackOrSession)->has($this->getCartKeyName($vendor));
    }

    public function getForVendor(VendorInterface $vendor): ?OrderStorageInterface
    {
        if ($this->hasForVendor($vendor)) {
            $cartId = SessionProvider::getSession($this->requestStackOrSession)->get($this->getCartKeyName($vendor));

            return $this->orderRepository->findCartByChannel($cartId, $vendor);
        }

        return null;
    }

    public function setForChannel(VendorInterface $vendor, OrderStorageInterface $cart): void
    {
        SessionProvider::getSession($this->requestStackOrSession)->set($this->getCartKeyName($vendor), $cart->getId());
    }

    public function removeForChannel(VendorInterface $vendor): void
    {
        SessionProvider::getSession($this->requestStackOrSession)->remove($this->getCartKeyName($vendor));
    }

    private function getCartKeyName(VendorInterface $vendor): string
    {
        return sprintf('%s.%s', $this->sessionKeyName, $vendor->getCode());
    }
}