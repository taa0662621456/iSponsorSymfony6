<?php

namespace App\Service\Setup;

use App\Interface\FactoryInterface;
use Doctrine\Persistence\ObjectManager;
use Composer\Repository\RepositoryInterface;
use App\EntityInterface\Locale\LocaleInterface;
use App\EntityInterface\Currency\CurrencyInterface;
use Symfony\Component\Notifier\Channel\ChannelInterface;

final class ChannelSetup implements ChannelSetupInterface
{
    public function __construct(
        private readonly RepositoryInterface $channelRepository,
        private readonly FactoryInterface $channelFactory,
        private readonly ObjectManager $channelManager,
    ) {
    }

    public function setup(LocaleInterface $locale, CurrencyInterface $currency): void
    {
        /** @var ChannelInterface|null $channel */
        $channel = $this->channelRepository->findOneBy([]);

        if (null === $channel) {
            /** @var ChannelInterface $channel */
            $channel = $this->channelFactory->createNew();
            $channel->setCode('default');
            $channel->setName('Default');
            $channel->setTaxCalculationStrategy('order_items_based');

            $this->channelManager->persist($channel);
        }

        $channel->addCurrency($currency);
        $channel->setBaseCurrency($currency);
        $channel->addLocale($locale);
        $channel->setDefaultLocale($locale);

        $this->channelManager->flush();
    }
}
