<?php

namespace App\Repository\Promotion;

use App\Entity\Vendor\Vendor;
use App\Interface\PromotionRepositoryInterface;
use App\Service\AssociationHydrate;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;


class PromotionRepository extends EntityManager
{
    private AssociationHydrate $associationHydrate;

    public function __construct(EntityManager $entityManager, ClassMetadata $class)
    {
        parent::__construct($entityManager, $class);

        $this->associationHydrate = new AssociationHydrate($entityManager, $class);
    }
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

    public function findActiveByVendor(Vendor $vendor): array
    {
        $promotions = $this->filterByActive($this->createQueryBuilder('o'))
            ->andWhere(':vendor MEMBER OF o.vendors')
            ->setParameter('vendor', $vendor)
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