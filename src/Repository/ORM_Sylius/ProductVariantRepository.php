<?php


namespace App\CoreBundle\Doctrine\ORM;

use Doctrine\ORM\QueryBuilder;




class ProductVariantRepository extends BaseProductVariantRepository implements ProductVariantRepositoryInterface
{
    public function createInventoryListQueryBuilder(string $locale): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere('o.tracked = :tracked')
            ->setParameter('locale', $locale)
            ->setParameter('tracked', true)
        ;
    }

    public function findByTaxon(TaxonInterface $taxon): array
    {
        return $this
            ->createQueryBuilder('variant')
            ->innerJoin('variant.product', 'product')
            ->innerJoin('product.productTaxons', 'productTaxon')
            ->andWhere('productTaxon.taxon = :taxon')
            ->setParameter('taxon', $taxon)
            ->getQuery()
            ->getResult()
        ;
    }

    public function createCatalogPromotionListQueryBuilder(
        string $locale,
        CatalogPromotionInterface $catalogPromotion,
    ): QueryBuilder {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->leftJoin('o.channelPricings', 'channelPricing')
            ->innerJoin('channelPricing.appliedPromotions', 'appliedPromotion', 'WITH', 'appliedPromotion = :catalogPromotion')
            ->setParameter('catalogPromotion', $catalogPromotion)
            ->setParameter('locale', $locale)
        ;
    }
}
