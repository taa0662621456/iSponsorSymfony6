<?php


namespace App\CoreBundle\Doctrine\ORM;




class ProductTaxonRepository extends EntityRepository implements ProductTaxonRepositoryInterface
{
    public function findOneByProductCodeAndTaxonCode(string $productCode, string $taxonCode): ?ProductTaxonInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.product', 'product')
            ->andWhere('product.code = :productCode')
            ->setParameter('productCode', $productCode)
            ->innerJoin('o.taxon', 'taxon')
            ->andWhere('taxon.code = :taxonCode')
            ->setParameter('taxonCode', $taxonCode)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
