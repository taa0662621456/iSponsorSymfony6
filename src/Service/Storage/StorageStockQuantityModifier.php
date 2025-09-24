<?php

namespace App\Service\Storage;

use App\Entity\Storage\Storage;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;

class StorageStockQuantityModifier
{

    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function incStorageStockQuantity(Storage $storage, int $quantity): void
    {
        $currentQuantity = $storage->getStorageStockQuantity();
        $newQuantity = $currentQuantity + $quantity;

        $storage->setStorageStockQuantity($newQuantity);

        $this->entityManager->persist($storage);
        $this->entityManager->flush();
    }

    public function decStorageStockQuantity(Storage $storage, int $quantity): void
    {
        $currentQuantity = $storage->getStorageStockQuantity();

        if ($currentQuantity >= $quantity) {
            $newQuantity = $currentQuantity - $quantity;

            $storage->setStorageStockQuantity($newQuantity);

            $this->entityManager->persist($storage);
            $this->entityManager->flush();
        } else {
            throw new InvalidArgumentException('Requested quantity exceeds available stock.');
        }
    }
}