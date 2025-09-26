<?php

namespace App\Service\Cart;

use App\Interface\CartSessionInterface;
use App\Repository\Order\OrderRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class CartSessionStorage implements CartSessionInterface
{
    public function __construct(
        private readonly RequestStack|SessionInterface $requestStackOrSession,
        private readonly string                        $sessionKeyName,
        private readonly OrderRepository      $orderRepository,
    ) {
        if ($requestStackOrSession instanceof SessionInterface) {
            trigger_deprecation('sylius/core-bundle', '1.12', sprintf('Passing an instance of %s as constructor argument for %s is deprecated as of Sylius 1.12 and will be removed in 2.0. Pass an instance of %s instead.', SessionInterface::class, self::class, RequestStack::class));
        }
    }

    public function hasForChannel(ChannelInterface $channel): bool
    {
        return SessionProvider::getSession($this->requestStackOrSession)->has($this->getCartKeyName($channel));
    }

    public function getForChannel(ChannelInterface $channel): ?OrderInterface
    {
        if ($this->hasForChannel($channel)) {
            $cartId = SessionProvider::getSession($this->requestStackOrSession)->get($this->getCartKeyName($channel));

            return $this->orderRepository->findCartByChannel($cartId, $channel);
        }

        return null;
    }

    public function setForChannel(ChannelInterface $channel, OrderInterface $cart): void
    {
        SessionProvider::getSession($this->requestStackOrSession)->set($this->getCartKeyName($channel), $cart->getId());
    }

    public function removeForChannel(ChannelInterface $channel): void
    {
        SessionProvider::getSession($this->requestStackOrSession)->remove($this->getCartKeyName($channel));
    }

    private function getCartKeyName(ChannelInterface $channel): string
    {
        return sprintf('%s.%s', $this->sessionKeyName, $channel->getCode());
    }
}
