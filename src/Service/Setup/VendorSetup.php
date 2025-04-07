<?php

namespace App\Service\Setup;

use App\EntityInterface\Currency\CurrencyInterface;
use App\EntityInterface\Locale\LocaleInterface;
use App\RepositoryInterface\Vendor\VendorRepositoryInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Notifier\Channel\ChannelInterface;

final class VendorSetup implements ChannelSetupInterface
{
    public function __construct(
        private readonly VendorRepositoryInterface $vendorRepository,
        private readonly FactoryInterface $vendorFactory,
        private readonly ObjectManager $vendorManager,
    ) {
    }

    public function setup(LocaleInterface $locale, CurrencyInterface $currency): void
    {
        /** @var ChannelInterface|null $vendor */
        $vendor = $this->vendorRepository->findOneBy([]);

        if (null === $vendor) {
            /** @var ChannelInterface $vendor */
            $vendor = $this->vendorFactory->createNew();
            $vendor->setCode('default');
            $vendor->setName('Default');
            $vendor->setTaxCalculationStrategy('order_items_based');

            $this->vendorManager->persist($vendor);
        }

        $vendor->addCurrency($currency);
        $vendor->setBaseCurrency($currency);
        $vendor->addLocale($locale);
        $vendor->setDefaultLocale($locale);

        $this->vendorManager->flush();
    }
}
