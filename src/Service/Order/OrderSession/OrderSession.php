<?php

namespace App\Service\Order\OrderSession;

use App\Exception\CartNotFoundException;
use App\RepositoryInterface\Order\OrderRepositoryInterface;
use App\Service\Order\CartContextInterface;
use App\Service\Order\OrderInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class OrderSession implements CartContextInterface
{
    public function __construct(
        private readonly SessionInterface         $session,
        private readonly string                   $sessionKeyName,
        private readonly OrderRepositoryInterface $orderRepository,
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