<?php

namespace App\Repository\Association;

use App\Repository\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use App\Entity\Association\AssociationProduct;
use App\EntityInterface\Vendor\VendorInterface;
use App\RepositoryInterface\Association\AssociationProductRepositoryInterface;

/**
 * @method AssociationProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociationProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociationProduct[]    findAll()
 * @method AssociationProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationProductRepository extends EntityRepository implements AssociationProductRepositoryInterface
{
    /**
     * @throws NonUniqueResultException
     */
    public function findWithProductsWithinVendor($associationId, VendorInterface $vendor): ProductAssociationInterface
    {
        return $this->createQueryBuilder('o')
            ->addSelect('associatedProduct')
            ->innerJoin('o.associatedProducts', 'associatedProduct', 'WITH', 'associatedProduct.enabled = true')
            ->innerJoin('associatedProduct.vendors', 'vendor', 'WITH', 'vendor = :vendor')
            ->andWhere('o.id = :associationId')
            ->setParameter('associationId', $associationId)
            ->setParameter('vendor', $vendor)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
