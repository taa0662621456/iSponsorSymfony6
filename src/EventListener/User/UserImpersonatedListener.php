<?php

namespace App\EventListener\User;

final class UserImpersonatedListener
{
    public function __construct(
        private CartStorageInterface $cartStorage,
        private ChannelContextInterface $channelContext,
        private OrderRepositoryInterface $orderRepository,
    ) {
    }

    public function onUserImpersonated(UserEvent $event): void
    {
        $user = $event->getUser();

        if (!$user instanceof ShopUserInterface) {
            return;
        }

        $customer = $user->getCustomer();

        $channel = $this->channelContext->getChannel();

        $cart = $this->orderRepository->findLatestCartByChannelAndCustomer($channel, $customer);

        if ($cart === null) {
            $this->cartStorage->removeForChannel($channel);

            return;
        }

        $this->cartStorage->setForChannel($channel, $cart);
    }
}
