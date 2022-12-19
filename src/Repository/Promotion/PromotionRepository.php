<?php

namespace App\Repository\Promotion;

use App\Entity\Vendor\Vendor;
use App\Interface\PromotionRepositoryInterface;
use App\Service\AssociationHydrate;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;


class PromotionRepository implements PromotionRepositoryInterface
{
    private AssociationHydrate $associationHydrate;

    public function findActive(): array
    {
        return $this->filterByActive($this->createQueryBuilder('o'))
            ->addOrderBy('o.priority', 'desc')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByName(string $name): array
    {
        return $this->findBy(['name' => $name]);
    }

    protected function filterByActive(QueryBuilder $queryBuilder, ?\DateTimeInterface $date = null): QueryBuilder
    {
        return $queryBuilder
            ->andWhere('o.startsAt IS NULL OR o.startsAt < :date')
            ->andWhere('o.endsAt IS NULL OR o.endsAt > :date')
            ->setParameter('date', $date ?: new \DateTime())
        ;
    }

    public function findActiveByChannel(Vendor $vendor): array
    {
        $promotions = $this->filterByActive($this->createQueryBuilder('o'))
            ->andWhere(':channel MEMBER OF o.channels')
            ->setParameter('channel', $vendor)
            ->addOrderBy('o.priority', 'DESC')
            ->getQuery()
            ->getResult()
        ;

        $this->associationHydrate->hydrateAssociations($promotions, [
            'rules',
        ]);

        return $promotions;
    }
}
