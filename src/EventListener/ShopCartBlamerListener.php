<?php

namespace App\EventListener;

use App\Event\Vendor\VendorEvent;
use App\Exception\CartNotFoundException;
use App\Exception\UnexpectedTypeException;
use App\Interface\Cart\CartInterface;
use App\Interface\Order\OrderInterface;
use App\Interface\SectionProviderInterface;
use App\Interface\Vendor\VendorInterface;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class ShopCartBlamerListener
{
    public function __construct(private readonly CartInterface            $cartContext,
                                private readonly SectionProviderInterface $uriBasedSectionContext)
    {
    }

    public function onImplicitLogin(VendorEvent $vendorEvent): void
    {

        $vendor = $vendorEvent->getUser();
        if (!$vendor instanceof VendorInterface) {
            return;
        }

        $this->blame($vendor);
    }

    public function onInteractiveLogin(InteractiveLoginEvent $interactiveLoginEvent): void
    {
        $section = $this->uriBasedSectionContext->getSection();

        $vendor = $interactiveLoginEvent->getAuthenticationToken()->getUser();
        if (!$vendor instanceof VendorInterface) {
            return;
        }

        $this->blame($vendor);
    }

    private function blame(VendorInterface $vendor): void
    {
        $order = $this->getCart();
        if (null === $order || null !== $order->getCreatedBy()) {
            return;
        }

        $order->setCreatedBy($vendor->getCreatedBy());
    }

    /**
     * @throws UnexpectedTypeException
     */
    private function getCart(): ?OrderInterface
    {
        try {
            $order = $this->cartContext->getCart();
        } catch (CartNotFoundException) {
            return null;
        }

        if (!$order instanceof OrderInterface) {
            throw new UnexpectedTypeException($order, OrderInterface::class);
        }

        return $order;
    }
}
