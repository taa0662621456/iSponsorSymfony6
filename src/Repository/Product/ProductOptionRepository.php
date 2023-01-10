<?php

namespace App\Repository\Product;

use App\Entity\Product\ProductStorage;
use App\Interface\Product\ProductOptionRepositoryInterface;
use App\Service\AssociationHydrate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductStorage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductStorage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductStorage[]    findAll()
 * @method ProductStorage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductOptionRepository extends ServiceEntityRepository implements ProductOptionRepositoryInterface
{
    protected AssociationHydrate $associationHydrate;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductStorage::class);

//        parent::__construct($entityManager, $class);
//        $this->associationHydrate = new AssociationHydrate($entityManager, $class);
    }

    // /**
    //  * @return ProductOption[] Returns an array of ProductOption objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductOption
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function createListQueryBuilder(string $locale): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation')
            ->andWhere('translation.locale = :locale')
            ->setParameter('locale', $locale)
            ;
    }

    public function findByName(string $name, string $locale): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation')
            ->andWhere('translation.name = :name')
            ->andWhere('translation.locale = :locale')
            ->setParameter('name', $name)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult()
            ;
    }

//    public function findAll(): array
//    {
//        $productOptions = parent::findAll();
//
//        $this->associationHydrate->hydrateAssociation($productOptions, 'translations');
//
//        return $productOptions;
//    }
}
