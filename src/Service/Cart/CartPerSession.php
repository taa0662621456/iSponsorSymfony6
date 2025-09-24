<?php

namespace App\Service\Cart;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class CartPerSession implements CartContextInterface
{
    public function __construct(
        private SessionInterface $session,
        private string $sessionKeyName,
        private OrderRepositoryInterface $orderRepository,
    ) {
    }

    public function getCart(): OrderInterface
    {
        if (!$this->session->has($this->sessionKeyName)) {
            throw new CartNotFoundException('iSponsor was not able to find the cart in session');
        }

        $cart = $this->orderRepository->findCartById($this->session->get($this->sessionKeyName));

        if (null === $cart) {
            $this->session->remove($this->sessionKeyName);

            throw new CartNotFoundException('iSponsor was not able to find the cart in session');
        }

        return $cart;
    }
}