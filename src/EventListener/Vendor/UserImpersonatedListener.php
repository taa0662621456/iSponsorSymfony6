<?php

namespace App\EventListener\Vendor;

use App\Interface\Channel\ChannelContextInterface;
use App\Interface\Order\OrderRepositoryInterface;
use App\Interface\Product\ProductStorageInterface;
use HWI\Bundle\OAuthBundle\Event\UserEvent;
use Symfony\Component\Security\Core\User\UserInterface;

final class UserImpersonatedListener
{
    public function __construct(
        private readonly ProductStorageInterface  $cartStorage,
        private readonly ChannelContextInterface  $channelContext,
        private readonly OrderRepositoryInterface $orderRepository,
    ) {
    }

    public function onUserImpersonated(UserEvent $event): void
    {
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $customer = $user->getCustomer();

        $channel = $this->channelContext->getChannel();

        $cart = $this->orderRepository->findLatestCartByChannelAndCustomer($channel, $customer);

        if (null === $cart) {
            $this->cartStorage->removeForChannel($channel);

            return;
        }

        $this->cartStorage->setForChannel($channel, $cart);
    }
}
