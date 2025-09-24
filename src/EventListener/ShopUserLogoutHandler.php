<?php

namespace App\EventListener;

final class ShopUserLogoutHandler
{
    public function __construct(
        private ChannelContextInterface $channelContext,
        private CartStorageInterface $cartStorage,
    ) {
    }

    public function onLogout(): void
    {
        /** @var ChannelInterface $channel */
        $channel = $this->channelContext->getChannel();
        $this->cartStorage->removeForChannel($channel);
    }
}