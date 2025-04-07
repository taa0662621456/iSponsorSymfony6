<?php

namespace App\EventListener\Listener_Sylius;

use App\Exception\UnexpectedTypeException;
use App\RepositoryInterface\Payment\ChannelRepositoryInterface;
use Symfony\Component\Notifier\Channel\ChannelInterface;
use function count;

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
            throw new UnexpectedTypeException($channel, ChannelInterface::class);
        }

        $results = $this->channelRepository->findBy(['enabled' => true]);

        if (!$results || (1 === count($results) && current($results) === $channel)) {
            $event->stop('sylius.channel.delete_error');
        }
    }
}
