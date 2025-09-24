<?php


namespace App\Repository\Product;

use App\Interface\Product\ProductTaxationInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

class ProductTaxationRepository extends EntityRepository
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
            ->getOneOrNullResult()
        ;
    }
}