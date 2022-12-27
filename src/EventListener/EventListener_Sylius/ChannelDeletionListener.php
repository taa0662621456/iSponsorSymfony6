<?php

namespace App\EventListener\EventListener_Sylius;

final class ChannelDeletionListener
{
    public function __construct(private readonly ChannelRepositoryInterface $channelRepository)
    {
    }

    /**
     * Prevent channel deletion if no more channels enabled.
     */
    public function onChannelPreDelete(ResourceControllerEvent $event): void
    {
        $channel = $event->getSubject();

        if (!$channel instanceof ChannelInterface) {
            throw new UnexpectedTypeException(
                $channel,
                ChannelInterface::class,
            );
        }

        $results = $this->channelRepository->findBy(['enabled' => true]);

        if (!$results || (count($results) === 1 && current($results) === $channel)) {
            $event->stop('sylius.channel.delete_error');
        }
    }
}
