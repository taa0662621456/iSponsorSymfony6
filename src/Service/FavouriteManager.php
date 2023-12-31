<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class FavouriteManager
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setFavourite(string $entity, object $createdBy): void
    {
        // TODO
    }

    public function getFavourites(string $entity, object $createdBy): array
    {
        $repository = $this->entityManager->getRepository($entity);

        return $repository->findBy([
            'createdBy' => $createdBy,
        ], [
            'createdAt' => 'ASC',
        ], 12, null);
    }

    public function removeFavourite(): void
    {
    }
}
