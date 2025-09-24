<?php

namespace App\Repository\Association;

use App\Repository\EntityRepository;
use App\Entity\Association\AssociationProject;
use App\EntityInterface\Vendor\VendorInterface;
use App\EntityInterface\Product\ProductAssociationInterface;
use App\RepositoryInterface\Association\AssociationProjectRepositoryInterface;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method AssociationProject|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociationProject|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociationProject[]    findAll()
 * @method AssociationProject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationProjectRepository extends EntityRepository implements AssociationProjectRepositoryInterface
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