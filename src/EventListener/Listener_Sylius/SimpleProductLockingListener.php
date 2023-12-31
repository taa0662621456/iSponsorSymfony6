<?php

namespace App\EventListener\Listener_Sylius;

use Doctrine\DBAL\LockMode;
use Webmozart\Assert\Assert;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

final class SimpleProductLockingListener
{
    public function __construct(private EntityManagerInterface $manager)
    {
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function lock(GenericEvent $event): void
    {
        $product = $event->getSubject();

        Assert::isInstanceOf($product, ProductInterface::class);

        if ($product->isSimple()) {
            /** @var ProductVariantInterface $productVariant */
            $productVariant = $product->getVariants()->first();
            $this->manager->lock($productVariant, LockMode::OPTIMISTIC, $productVariant->getVersion());
        }
    }
}
