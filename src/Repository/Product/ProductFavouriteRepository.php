<?php


namespace App\Repository\Product;

use App\Entity\Product\ProductFavourite;
use App\Entity\Vendor\VendorFavourite;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductFavourite|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductFavourite|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductFavourite[]    findAll()
 * @method ProductFavourite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductFavouriteRepository extends EntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductFavourite::class);
    }
    /**
     * @param VendorFavourite $vendor
     * @param integer $productId
     *
     * @return bool|null
     */
    public function checkIsLiked(VendorFavourite $vendor, int $productId): ?bool
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('count(f.id)')
			->from(ProductFavourite::class, 'f')
            ->innerJoin('f.vendor', 'v')
            ->innerJoin('f.product', 'p')
            ->where('v = :vendor')
            ->andWhere('p.id = :product_id')
            ->setParameters([
                'product_id' => $productId,
                'vendor' => $vendor
            ]);

        try {
            if ($qb->getQuery()->getSingleScalarResult()) {
                return true;
            }
        } catch (NoResultException|NonUniqueResultException $e) {
        }

        return false;
    }
}
