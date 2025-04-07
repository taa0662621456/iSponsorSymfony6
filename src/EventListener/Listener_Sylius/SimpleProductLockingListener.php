<?php

namespace App\EventListener\Listener_Sylius;

use App\EntityInterface\Product\ProductInterface;
use App\EntityInterface\Product\ProductVariantInterface;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\PessimisticLockException;
use Webmozart\Assert\Assert;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

final class SimpleProductLockingListener
{
    public function __construct(private readonly EntityManagerInterface $manager)
    {
    }

    /**
     * @param GenericEvent $event
     * @throws OptimisticLockException
     * @throws PessimisticLockException
     */
    public function lock(GenericEvent $event): void
    {
        $product = $event->getSubject();

        Assert::isInstanceOf($product, ProductInterface::class);

        if ($product->isSimple()) {
            /** @var ProductVariantInterface $productVariant */
            $productVariant = $product->getVariants()->first();
            try {
                $this->manager->lock($productVariant, LockMode::OPTIMISTIC, $productVariant->getVersion());
            } catch (OptimisticLockException|PessimisticLockException $e) {
            }
        }
    }
}
