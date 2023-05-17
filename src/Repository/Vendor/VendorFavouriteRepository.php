<?php


namespace App\Repository\Vendor;

use App\Entity\Vendor\VendorFavourite;
use App\RepositoryInterface\Vendor\VendorFavouriteRepositoryInterface;
use App\Repository\EntityRepository;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VendorFavourite|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorFavourite|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorFavourite[]    findAll()
 * @method VendorFavourite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorFavouriteRepository extends EntityRepository implements VendorFavouriteRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VendorFavourite::class);
    }
    /**
     * @param VendorFavourite $vendor
     * @param integer $vendorId
     *
     * @return bool|null
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function checkIsLiked(VendorFavourite $vendor, int $vendorId): ?bool
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('count(f.id)')
			->from(VendorFavourite::class, 'f')
            ->innerJoin('f.vendor', 'v')
            ->innerJoin('f.vendor', 'p')
            ->where('v = :vendor')
            ->andWhere('p.id = :vendor_id')
            ->setParameters([
                'vendor_id' => $vendorId,
                'vendor' => $vendor
            ]);

        if ($qb->getQuery()->getSingleScalarResult()) {
            return true;
        }

        return false;
    }
}
