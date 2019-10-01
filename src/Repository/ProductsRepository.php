<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Category\Categories;
use App\Entity\Product\Products;
use App\Entity\Vendor\Vendors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    /**
     * ProductsRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Products::class);
    }
    /**
     * @param string $slug
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function findBySlug($slug)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb->select('p')
            ->from('ProductsEnGb', 'p')
            ->where('p.slug = :slug')
            ->andWhere($qb->expr()->neq('p.deleted', 1))
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }


    // /**
    //  * @return Products[] Returns an array of Products objects
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
    public function findOneBySomeField($value): ?Products
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
	public function findBySearchQuery($query, $limit)
	{
		//TODO
	}

}
