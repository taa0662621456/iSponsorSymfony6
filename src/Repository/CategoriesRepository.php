<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Category\Categories;
use App\Entity\Category\CategoriesCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Categories|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categories|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categories[]    findAll()
 * @method Categories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Categories::class);
    }

    /**
     * @param $category
     * @param CategoriesCategory $categories
     * @return Categories[] Returns an array of Categories objects
     */
    public function ffff($category, CategoriesCategory $categories): array
    {
        return $this
            ->createQueryBuilder('CategoriesCategory')
            ->where('categories.category_parent_id = category')
            ->andWhere('category_parent_id = :category')
            ->setParameter('category', $category)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Categories[] Returns an array of Categories objects
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
    public function findOneBySomeField($value): ?Categories
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
