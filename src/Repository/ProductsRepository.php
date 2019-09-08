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

    /**
     * @param Categories $category
     * @param Vendors|null $vendors
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findByCategoryQB(Categories $category, Vendors $vendors = null): \Doctrine\ORM\QueryBuilder
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['p', 'pi', 'pm', 'pfa', 'pfe'])
            ->from('Products', 'p')
            ->innerJoin('p.category', 'ca')
            ->leftJoin('p.images', 'pi')
            ->leftJoin('p.measure', 'pm')
            ->leftJoin('p.favourites', 'pfa', 'WITH', 'pfa.vendor = :vendor')
            ->leftJoin('p.featured', 'pfe')
            ->where('ca = :category')
            ->andWhere('p.quantity <> 0')
            ->andWhere($qb->expr()->neq('p.deleted', 1))
            ->setParameter('category', $category)
            ->setParameter('vendor', $vendors);

        return $qb;
    }

    /**
     * @param Manufacturers $manufacturer
     * @param Vendors $vendor
     * @return QueryBuilder
     */
    public function findByManufacturerQB(Manufacturers $manufacturer, Vendors $vendor = null): QueryBuilder
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['p', 'pi', 'pm', 'pfa', 'pfe'])
            ->from('Products', 'p')
            ->innerJoin('p.manufacturer', 'ma')
            ->leftJoin('p.images', 'pi')
            ->leftJoin('p.measure', 'pm')
            ->leftJoin('p.favourites', 'pfa', 'WITH', 'pfa.vendor = :vendor') //if liked
            ->leftJoin('p.featured', 'pfe')
            ->where('ma.id = :manufacturer')
            ->andWhere('p.quantity <> 0')
            ->andWhere($qb->expr()->neq('p.deleted', 1))
            ->setParameter('manufacturer', $manufacturer)
            ->setParameter('vendor', $vendor);

        return $qb;
    }

    /**
     * @param User $user
     * @return QueryBuilder
     */
    public function getFavouritesQB($user = null)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['p', 'pi', 'pm', 'pfa', 'pfe'])
            ->from('ShopBundle:Product', 'p')
            ->leftJoin('p.images', 'pi')
            ->leftJoin('p.measure', 'pm')
            ->innerJoin('p.favourites', 'pfa', 'WITH', 'pfa.user = :user') //only liked
            ->leftJoin('p.featured', 'pfe')
            ->andWhere('p.quantity <> 0')
            ->andWhere($qb->expr()->neq('p.deleted', 1))
            ->setParameter('user', $user);

        return $qb;
    }

    /**
     * @param array $searchWords
     * @param User $user
     * @return QueryBuilder
     */
    public function getSearchQB($searchWords, $user = null)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['p', 'pi', 'pm', 'pfa', 'pfe'])
            ->from('ShopBundle:Product', 'p')
            ->leftJoin('p.images', 'pi')
            ->leftJoin('p.measure', 'pm')
            ->leftJoin('p.favourites', 'pfa', 'WITH', 'pfa.user = :user') //if liked
            ->leftJoin('p.featured', 'pfe')
            ->where('p.quantity <> 0')
            ->andWhere($qb->expr()->neq('p.deleted', 1))
            ->setParameter('user', $user);

        $cqbORX = [];
        foreach ($searchWords as $searchWord) {
            $cqbORX[] = $qb->expr()->like('p.name', $qb->expr()->literal('%' . $searchWord . '%'));
            $cqbORX[] = $qb->expr()->like('p.description', $qb->expr()->literal('%' . $searchWord . '%'));
        }

        $qb->andWhere(call_user_func_array([$qb->expr(), "orx"], $cqbORX));

        return $qb;
    }

    /**
     * @param int $quantity
     * @param User $user
     * @return array
     */
    public function getLatest($quantity = 1, $user = null)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['p', 'pi', 'pm', 'pfa', 'pfe'])
            ->from('ShopBundle:Product', 'p')
            ->leftJoin('p.images', 'pi')
            ->leftJoin('p.measure', 'pm')
            ->leftJoin('p.favourites', 'pfa', 'WITH', 'pfa.user = :user') //if liked
            ->leftJoin('p.featured', 'pfe')
            ->where('p.quantity <> 0')
            ->andWhere($qb->expr()->neq('p.deleted', 1))
            ->setMaxResults($quantity)
            ->setParameter('user', $user)
            ->addOrderBy('p.dateCreated', 'DESC');

        return $qb->getQuery()->getResult();
    }

    /**
     * @param int $quantity
     * @param User $user
     * @return array
     */
    public function getFeatured($quantity = 1, $user = null)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['p', 'pi', 'pm', 'pfa', 'pfe'])
            ->from('ShopBundle:Product', 'p')
            ->leftJoin('p.images', 'pi')
            ->leftJoin('p.measure', 'pm')
            ->leftJoin('p.favourites', 'pfa', 'WITH', 'pfa.user = :user') //if liked
            ->innerJoin('p.featured', 'pfe')
            ->where('p.quantity <> 0')
            ->andWhere($qb->expr()->neq('p.deleted', 1))
            ->setMaxResults($quantity)
            ->setParameter('user', $user)
            ->addOrderBy('pfe.productOrder', 'DESC');

        return $qb->getQuery()->getResult();
    }

    /**
     * @param int $quantity
     * @param array $productLspArray
     * @param User $user
     * @return array
     */
    public function getLastSeen($quantity = 1, $productLspArray, $user)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['p', 'pi', 'pm', 'pfa', 'pfe'])
            ->from('ShopBundle:Product', 'p')
            ->leftJoin('p.images', 'pi')
            ->leftJoin('p.measure', 'pm')
            ->leftJoin('p.favourites', 'pfa', 'WITH', 'pfa.user = :user') //if liked
            ->leftJoin('p.featured', 'pfe')
            ->where('p.quantity <> 0')
            ->andWhere('p.id IN (:ids)')
            ->setMaxResults($quantity)
            ->setParameters(['user' => $user, 'ids' => $productLspArray]);

        return $qb->getQuery()->getResult();
    }

    /**
     * return products for admin
     *
     * @return QueryBuilder
     */
    public function getAllProductsAdminQB()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['p', 'pi', 'pm', 'pc', 'pfe'])
            ->from('ShopBundle:Product', 'p')
            ->leftJoin('p.images', 'pi')
            ->leftJoin('p.manufacturer', 'pm')
            ->leftJoin('p.category', 'pc')
            ->leftJoin('p.featured', 'pfe')
            ->where($qb->expr()->neq('p.deleted', 1));

        return $qb;
    }

    /**
     * return products for admin
     *
     * @param string $searchWords
     * @return QueryBuilder
     */
    public function searchProductsAdminQB($searchWords)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('p', 'pi', 'pm', 'pc', 'pfe')
            ->from('ShopBundle:Product', 'p')
            ->leftJoin('p.images', 'pi')
            ->leftJoin('p.manufacturer', 'pm')
            ->leftJoin('p.category', 'pc')
            ->leftJoin('p.featured', 'pfe')
            ->where($qb->expr()->neq('p.deleted', 1));

        $searchWords = explode(' ', $searchWords);
        $cqbORX = [];

        foreach ($searchWords as $searchWord) {
            $cqbORX[] = $qb->expr()->like('p.name', $qb->expr()->literal('%' . $searchWord . '%'));
            $cqbORX[] = $qb->expr()->like('p.description', $qb->expr()->literal('%' . $searchWord . '%'));
        }

        $qb->andWhere(call_user_func_array([$qb->expr(), "orx"], $cqbORX));

        return $qb;
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

}
