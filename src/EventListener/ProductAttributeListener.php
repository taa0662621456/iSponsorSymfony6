<?php

namespace App\EventListener;

use App\EntityInterface\Product\ProductAttributeInterface;
use App\EntityInterface\Product\ProductAttributeValueInterface;
use App\RepositoryInterface\Product\ProductAttributeValueRepositoryInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\Event\LifecycleEventArgs as BaseLifecycleEventArgs;

final class ProductAttributeListener
{
    public const TYPE = '';

    public function __construct(private readonly string $productAttributeValueClass)
    {
    }

    public function postUpdate(BaseLifecycleEventArgs $event): void
    {
        $productAttribute = $event->getObject();

        if (!$productAttribute instanceof ProductAttributeInterface) {
            return;
        }

        // if (SelectAttributeType::TYPE !== $productAttribute->getType()) {
        if (self::TYPE !== $productAttribute->getType()) {
            return;
        }

        $entityManager = $event->getObjectManager();

        $unitOfWork = $entityManager->getUnitOfWork();
        $changeSet = $unitOfWork->getEntityChangeSet($productAttribute);

        $oldChoices = $changeSet['configuration'][0]['choices'] ?? [];
        $newChoices = $changeSet['configuration'][1]['choices'] ?? [];

        $removedChoices = array_diff_key($oldChoices, $newChoices);
        if (!empty($removedChoices)) {
            $this->removeValues($entityManager, array_keys($removedChoices));
        }
    }

    /**
     * @param array|string[] $choiceKeys
     */
    public function removeValues(ObjectManager $entityManager, array $choiceKeys): void
    {
        /** @var ProductAttributeValueRepositoryInterface $productAttributeValueRepository */
        $productAttributeValueRepository = $entityManager->getRepository($this->productAttributeValueClass);
        foreach ($choiceKeys as $choiceKey) {
            $productAttributeValues = $productAttributeValueRepository->findByJsonChoiceKey($choiceKey);

            /** @var ProductAttributeValueInterface $productAttributeValue */
            foreach ($productAttributeValues as $productAttributeValue) {
                $newValue = array_diff($productAttributeValue->getValue(), [$choiceKey]);
                if (!empty($newValue)) {
                    $productAttributeValue->setValue($newValue);

                    continue;
                }

                $entityManager->remove($productAttributeValue);
            }
        }

        $entityManager->flush();
    }
}