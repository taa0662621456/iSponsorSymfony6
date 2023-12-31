<?php

namespace App\Repository\Product;

use App\Repository\EntityRepository;
use App\Entity\Product\ProductTaxation;
use Doctrine\ORM\NonUniqueResultException;
use App\EntityInterface\Product\ProductTaxationInterface;

/**
 * @method ProductTaxation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductTaxation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductTaxation[]    findAll()
 * @method ProductTaxation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductTaxationRepository extends EntityRepository implements ProductTaxationInterface
{
    /**
     * @throws NonUniqueResultException
     */
    public function findOneByProductCodeAndTaxonCode(string $productCode, string $taxCode): ?ProductTaxationInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.product', 'product')
            ->andWhere('product.code = :productCode')
            ->setParameter('productCode', $productCode)
            ->innerJoin('o.tax', 'tax')
            ->andWhere('tax.code = :taxCode')
            ->setParameter('taxCode', $taxCode)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
