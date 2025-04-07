<?php

namespace App\EventListener\Vendor;

use App\EntityInterface\Channel\ChannelContextInterface;
use App\EntityInterface\Product\ProductStorageInterface;
use App\RepositoryInterface\Order\OrderRepositoryInterface;
use HWI\Bundle\OAuthBundle\Event\UserEvent;
use Symfony\Component\Security\Core\User\UserInterface;

final class UserImpersonatedListener
{
    public function __construct(
        private readonly ProductStorageInterface $cartStorage,
        private readonly ChannelContextInterface $channelContext,
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
