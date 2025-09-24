<?php

namespace App\EventListener\User;

use App\SectionResolver\ShopSection;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Webmozart\Assert\Assert;

final class UserCartRecalculationListener
{
    public function __construct(
        private CartContextInterface $cartContext,
        private OrderProcessorInterface $orderProcessor,
        private SectionProviderInterface $uriBasedSectionContext,
    ) {
    }

    /**
     * @param InteractiveLoginEvent|UserEvent $event
     */
    public function recalculateCartWhileLogin(object $event): void
    {
        if (!$this->uriBasedSectionContext->getSection() instanceof ShopSection) {
            return;
        }

        /** @psalm-suppress DocblockTypeContradiction */
        if (!$event instanceof InteractiveLoginEvent && !$event instanceof UserEvent) {
            throw new \TypeError(sprintf(
                '$event needs to be an instance of "%s" or "%s"',
                InteractiveLoginEvent::class,
                UserEvent::class,
            ));
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