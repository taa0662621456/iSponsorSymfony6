<?php

namespace App\Repository\Association;

use App\Repository\EntityRepository;
use App\Entity\Association\Association;
use App\EntityInterface\Vendor\VendorInterface;
use App\RepositoryInterface\Association\AssociationReposit;
use App\EntityInterface\Product\ProductAssociationInterface;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Association|null find($id, $lockMode = null, $lockVersion = null)
 * @method Association|null findOneBy(array $criteria, array $orderBy = null)
 * @method Association[]    findAll()
 * @method Association[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationRepository extends EntityRepository implements AssociationReposit
{
    public function findWithProductsWithinVendor($associationId, VendorInterface $vendor): ProductAssociationInterface
    {
        try {
            return $this->createQueryBuilder('o')
                ->addSelect('associatedProduct')
                ->innerJoin('o.associatedProducts', 'associatedProduct', 'WITH', 'associatedProduct.enabled = true')
                ->innerJoin('associatedProduct.vendors', 'vendor', 'WITH', 'vendor = :vendor')
                ->andWhere('o.id = :associationId')
                ->setParameter('associationId', $associationId)
                ->setParameter('vendor', $vendor)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        throw $e;
        }
        return 'null';
    }
}