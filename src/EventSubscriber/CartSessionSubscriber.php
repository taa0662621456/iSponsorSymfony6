<?php

namespace App\EventSubscriber;

use Webmozart\Assert\Assert;
use JetBrains\PhpStorm\ArrayShape;
use App\Exception\CartNotFoundException;
use App\EntityInterface\Order\OrderStorageInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use App\ServiceInterface\Cart\CartContextServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class CartSessionSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly CartContextServiceInterface $cartContext)
    {
    }

    #[ArrayShape([KernelEvents::RESPONSE => 'string[]'])]
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => ['onKernelResponse'],
        ];
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        if (method_exists($event, 'isMainRequest')) {
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

            Assert::isInstanceOf($cart, OrderStorageInterface::class);
        } catch (CartNotFoundException) {
            return;
        }
    }
}
