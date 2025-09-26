<?php

namespace App\EventListener;

use App\SectionResolver\ShopSection;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

final class ShopCartBlamerListener
{
    public function __construct(private CartContextInterface $cartContext, private SectionProviderInterface $uriBasedSectionContext)
    {
    }

    public function onImplicitLogin(UserEvent $userEvent): void
    {
        if (!$this->uriBasedSectionContext->getSection() instanceof ShopSection) {
            return;
        }

        $user = $userEvent->getUser();
        if (!$user instanceof ShopUserInterface) {
            return;
        }

        $this->blame($user);
    }

    public function onInteractiveLogin(InteractiveLoginEvent $interactiveLoginEvent): void
    {
        $section = $this->uriBasedSectionContext->getSection();
        if (!$section instanceof ShopSection) {
            return;
        }

        $user = $interactiveLoginEvent->getAuthenticationToken()->getUser();
        if (!$user instanceof ShopUserInterface) {
            return;
        }

        $this->blame($user);
    }

    private function blame(ShopUserInterface $user): void
    {
        $cart = $this->getCart();
        if (null === $cart || null !== $cart->getCustomer()) {
            return;
        }

        $cart->setCustomerWithAuthorization($user->getCustomer());
    }

    /**
     * @throws UnexpectedTypeException
     */
    private function getCart(): ?OrderInterface
    {
        try {
            $cart = $this->cartContext->getCart();
        } catch (CartNotFoundException) {
            return null;
        }

        if (!$cart instanceof OrderInterface) {
            throw new UnexpectedTypeException($cart, OrderInterface::class);
        }

        return $cart;
    }
}
