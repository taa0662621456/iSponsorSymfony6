<?php

namespace App\EventListener;

use Webmozart\Assert\Assert;
use App\Event\Vendor\VendorEvent;
use App\Interface\Cart\CartInterface;
use App\Interface\Order\OrderInterface;
use App\Exception\CartNotFoundException;
use App\Interface\Order\OrderProcessorInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

final class CartRecalculationListener
{
    public function __construct(
        private readonly CartInterface $cartContext,
        private readonly OrderProcessorInterface $orderProcessor,
    ) {
    }

    public function recalculateCartWhileLogin(object $event): void
    {
        /* @psalm-suppress DocblockTypeContradiction */
        if (!$event instanceof InteractiveLoginEvent && !$event instanceof VendorEvent) {
            throw new \TypeError(sprintf('$event needs to be an instance of "%s" or "%s"', InteractiveLoginEvent::class, VendorEvent::class));
        }

        try {
            $cart = $this->cartContext->getCart();
        } catch (CartNotFoundException) {
            return;
        }

        Assert::isInstanceOf($cart, OrderInterface::class);

        $this->orderProcessor->process($cart);
    }
}
