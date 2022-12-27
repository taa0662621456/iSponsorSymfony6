<?php

namespace App\EventListener;

use App\Exception\CartNotFoundException;
use App\Interface\Cart\CartContextInterface;
use App\Interface\Cart\CartStorageInterface;
use App\Interface\Order\OrderInterface;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Webmozart\Assert\Assert;

final class CartSessionSubscriber implements EventSubscriberInterface
{
    //public function __construct(private readonly CartContextInterface $cartContext,
    public function __construct(private readonly CartContextInterface $cartContext,
                                private readonly CartStorageInterface $cartStorage)
    {
    }

    #[ArrayShape([KernelEvents::RESPONSE => "string[]"])]
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => ['onKernelResponse'],
        ];
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        if (\method_exists($event, 'isMainRequest')) {
            $isMainRequest = $event->isMainRequest();
        } else {
            /** @phpstan-ignore-next-line */
            $isMainRequest = $event->isMainRequest();
        }
        if (!$isMainRequest) {
            return;
        }

        $request = $event->getRequest();

        if (!$request->hasSession() || !$request->getSession()->isStarted()) {
            return;
        }

        try {
            $cart = $this->cartContext->getCart();

            Assert::isInstanceOf($cart, OrderInterface::class);
        } catch (CartNotFoundException) {
            return;
        }

        if (null !== $cart->getId() && null !== $cart->getChannel()) {
            $this->cartStorage->setForChannel($cart->getChannel(), $cart);
        }
    }
}
