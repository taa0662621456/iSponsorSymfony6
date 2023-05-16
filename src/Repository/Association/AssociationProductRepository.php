<?php


namespace App\Repository\Association;

use App\Interface\Product\ProductAssociationInterface;
use App\Interface\Vendor\VendorInterface;
use Doctrine\ORM\EntityRepository;

class AssociationProductRepository extends EntityRepository
{
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
            ->getOneOrNullResult()
        ;
    }
}
