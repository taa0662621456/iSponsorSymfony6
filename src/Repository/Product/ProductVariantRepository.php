<?php

namespace App\Repository\Product;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;

use App\Entity\Product\Product;
use App\Repository\EntityRepository;
use App\EntityInterface\Taxation\TaxationInterface;
use App\EntityInterface\Product\ProductVariantInterface;
use App\EntityInterface\Product\ProductPropertyInterface;
use App\EntityInterface\Promotion\PromotionCatalogInterface;
use App\RepositoryInterface\Product\ProductVariantRepositoryInterface;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductVariantRepository extends EntityRepository implements ProductVariantRepositoryInterface
{
    public function createQueryBuilderByProductId(string $locale, $productId): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation')
            ->andWhere('translation.locale = :locale')
            ->andWhere('o.product = :productId')
            ->setParameter('locale', $locale)
            ->setParameter('productId', $productId);
    }

    public function createQueryBuilderByProductCode(string $locale, string $productCode): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation')
            ->innerJoin('o.product', 'product')
            ->andWhere('translation.locale = :locale')
            ->andWhere('product.code = :productCode')
            ->setParameter('locale', $locale)
            ->setParameter('productCode', $productCode);
    }

    public function findByName(string $name, string $locale): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation')
            ->andWhere('translation.name = :name')
            ->andWhere('translation.locale = :locale')
            ->setParameter('name', $name)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult();
    }

    public function findByNameAndProduct(string $name, string $locale, ProductPropertyInterface $product): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation')
            ->andWhere('translation.name = :name')
            ->andWhere('translation.locale = :locale')
            ->andWhere('o.product = :product')
            ->setParameter('name', $name)
            ->setParameter('locale', $locale)
            ->setParameter('product', $product)
            ->getQuery()
            ->getResult();
    }

    public function findOneByCodeAndProductCode(string $code, string $productCode): ?ProductVariantInterface
    {
        try {
            return $this->createQueryBuilder('o')
                ->innerJoin('o.product', 'product')
                ->andWhere('product.code = :productCode')
                ->andWhere('o.code = :code')
                ->setParameter('productCode', $productCode)
                ->setParameter('code', $code)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

    public function findByCodesAndProductCode(array $codes, string $productCode): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.product', 'product')
            ->andWhere('product.code = :productCode')
            ->andWhere('o.code IN (:codes)')
            ->setParameter('productCode', $productCode)
            ->setParameter('codes', $codes)
            ->getQuery()
            ->getResult();
    }

    public function findByCodes(array $codes): array
    {
        return $this->createQueryBuilder('o')
            ->addSelect('product')
            ->addSelect('channelPricings')
            ->addSelect('appliedPromotions')
            ->addSelect('productTaxon')
            ->addSelect('taxon')
            ->leftJoin('o.channelPricings', 'channelPricings')
            ->leftJoin('channelPricings.appliedPromotions', 'appliedPromotions')
            ->leftJoin('o.product', 'product')
            ->leftJoin('product.productTaxons', 'productTaxon')
            ->leftJoin('productTaxon.taxon', 'taxon')
            ->andWhere('o.code IN (:codes)')
            ->setParameter('codes', $codes)
            ->getQuery()
            ->getResult();
    }

    public function findOneByIdAndProductId($id, $productId): ?ProductVariantInterface
    {
        try {
            return $this->createQueryBuilder('o')
                ->andWhere('o.product = :productId')
                ->andWhere('o.id = :id')
                ->setParameter('productId', $productId)
                ->setParameter('id', $id)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

    public function findByPhraseAndProductCode(string $phrase, string $locale, string $productCode): array
    {
        $expr = $this->getEntityManager()->getExpressionBuilder();

        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->innerJoin('o.product', 'product')
            ->andWhere('product.code = :productCode')
            ->andWhere($expr->orX(
                'translation.name LIKE :phrase',
                'o.code LIKE :phrase',
            ))
            ->setParameter('phrase', '%'.$phrase.'%')
            ->setParameter('locale', $locale)
            ->setParameter('productCode', $productCode)
            ->getQuery()
            ->getResult();
    }

    public function findByPhrase(string $phrase, string $locale, int $limit = null): array
    {
        $expr = $this->getEntityManager()->getExpressionBuilder();

        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere($expr->orX(
                'translation.name LIKE :phrase',
                'o.code LIKE :phrase',
            ))
            ->setParameter('phrase', '%'.$phrase.'%')
            ->setParameter('locale', $locale)
            ->orderBy('o.product', 'ASC')
            ->addOrderBy('o.position', 'ASC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getCodesOfAllVariants(): array
    {
        return $this->createQueryBuilder('o')
            ->select('o.code')
            ->getQuery()
            ->getArrayResult();
    }

    public function createInventoryListQueryBuilder(string $locale): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere('o.tracked = :tracked')
            ->setParameter('locale', $locale)
            ->setParameter('tracked', true);
    }

    public function findByTaxon(TaxationInterface $taxon): array
    {
        return $this
            ->createQueryBuilder('variant')
            ->innerJoin('variant.product', 'product')
            ->innerJoin('product.productTaxons', 'productTaxon')
            ->andWhere('productTaxon.taxon = :taxon')
            ->setParameter('taxon', $taxon)
            ->getQuery()
            ->getResult();
    }

    public function createCatalogPromotionListQueryBuilder(
        string $locale,
        PromotionCatalogInterface $catalogPromotion,
    ): QueryBuilder {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->leftJoin('o.channelPricings', 'channelPricing')
            ->innerJoin('channelPricing.appliedPromotions', 'appliedPromotion', 'WITH', 'appliedPromotion = :catalogPromotion')
            ->setParameter('catalogPromotion', $catalogPromotion)
            ->setParameter('locale', $locale);
    }
}
