<?php

namespace App\Repository\Promotion;

use App\Entity\Vendor\Vendor;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Promotion\Promotion;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Promotion\PromotionRepositoryInterface;

/**
 * @method Promotion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Promotion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Promotion[]    findAll()
 * @method Promotion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @property mixed $associationHydrate
 */
class PromotionRepository extends EntityRepository implements PromotionRepositoryInterface
{
    // private AssociationHydrate $associationHydrate;

    //    public function __construct(
    //        // EntityManager $entityManager,
    //        // ClassMetadata $class
    //    ) {
    //        // parent::__construct($entityManager, $class);
    //
    //        $this->associationHydrate = new AssociationHydrate($entityManager, $class);
    //    }

    public function findActive(): array
    {
        return $this->filterByActive($this->createQueryBuilder('o'))
            ->addOrderBy('o.priority', 'desc')
            ->getQuery()
            ->getResult();
    }

    public function findByName(string $name): array
    {
        return $this->findBy(['name' => $name]);
    }

    protected function filterByActive(QueryBuilder $queryBuilder, DateTimeInterface $date = null): QueryBuilder
    {
        return $queryBuilder
            ->andWhere('o.startsAt IS NULL OR o.startsAt < :date')
            ->andWhere('o.endsAt IS NULL OR o.endsAt > :date')
            ->setParameter('date', $date ?: new DateTime());
    }

    public function findActiveByVendor(Vendor $vendor): array
    {
        $promotions = $this->filterByActive($this->createQueryBuilder('o'))
            ->andWhere(':vendor MEMBER OF o.vendors')
            ->setParameter('vendor', $vendor)
            ->addOrderBy('o.priority', 'DESC')
            ->getQuery()
            ->getResult();

        $this->associationHydrate->hydrateAssociations($promotions, [
            'rules',
        ]);

        return $promotions;
    }
}
