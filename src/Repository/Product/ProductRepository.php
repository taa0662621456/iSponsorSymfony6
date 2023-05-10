<?php

namespace App\Repository\Product;

use App\Entity\Product\Product;
use App\Interface\Product\ProductPropertyInterface;
use App\Interface\Product\ProductRepositoryInterface;
use App\Interface\Taxation\TaxationInterface;
use App\Interface\Vendor\VendorInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    // private AssociationHydrate $associationHydrate;

    public function __construct(ManagerRegistry $registry,
                                // EntityManager $entityManager,
                                // ClassMetadata $class
    ) {
        parent::__construct($registry, Product::class);
        // $this->associationHydrate = new AssociationHydrate($entityManager, $class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findBySlug(string $slug): mixed
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        return $qb->select('p')
            ->from('ProductsEnGb', 'p')
            ->where('p.slug = :slug')
            ->andWhere($qb->expr()->neq('p.deleted', 1))
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // /**
    //  * @return Products[] Returns an array of Products objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Products
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findBySearchQuery($query, $limit)
    {
        // TODO
    }

    public function createListQueryBuilder(string $locale, $taxonId = null): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->leftJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->setParameter('locale', $locale)
        ;

        if (null !== $taxonId) {
            $queryBuilder
                ->innerJoin('o.productTaxations', 'productTaxation')
                ->andWhere('productTaxation.taxon = :taxonId')
                ->setParameter('taxonId', $taxonId)
            ;
        }

        return $queryBuilder;
    }

    public function createShopListQueryBuilder(
        VendorInterface $vendor,
        TaxationInterface $tax,
        string $locale,
        array $sorting = [],
        bool $includeAllDescendants = false,
    ): QueryBuilder {
        $queryBuilder = $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->addSelect('productTaxation')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->innerJoin('o.productTaxations', 'productTaxation')
        ;

        if ($includeAllDescendants) {
            $queryBuilder
                ->innerJoin('productTaxation.taxon', 'taxon')
                ->andWhere('taxon.left >= :taxonLeft')
                ->andWhere('taxon.right <= :taxonRight')
                ->andWhere('taxon.root = :taxonRoot')
                ->setParameter('taxonLeft', $tax->getLeft())
                ->setParameter('taxonRight', $tax->getRight())
                ->setParameter('taxonRoot', $tax->getRoot())
            ;
        } else {
            $queryBuilder
                ->andWhere('productTaxation.taxon = :taxon')
                ->setParameter('taxon', $tax)
            ;
        }

        if (empty($sorting)) {
            $queryBuilder
                ->leftJoin('o.productTaxations', 'productTaxations', 'WITH', 'productTaxations.taxon = :taxonId')
                ->orderBy('productTaxations.position', 'ASC')
                ->setParameter('taxonId', $tax->getId())
            ;
        }

        $queryBuilder
            ->andWhere(':vendor MEMBER OF o.vendors')
            ->andWhere('o.enabled = :enabled')
            ->setParameter('locale', $locale)
            ->setParameter('vendor', $vendor)
            ->setParameter('enabled', true)
        ;

        // Grid hack, we do not need to join these if we don't sort by price
        if (isset($sorting['price'])) {
            // Another hack, the subquery to get the first position variant
            $subQuery = $this->createQueryBuilder('m')
                ->select('min(v.position)')
                ->innerJoin('m.variants', 'v')
                ->andWhere('m.id = :product_id')
                ->andWhere('v.enabled = :enabled')
            ;

            $queryBuilder
                ->addSelect('variant')
                ->addSelect('vendorPricing')
                ->innerJoin('o.variants', 'variant')
                ->innerJoin('variant.vendorPricings', 'vendorPricing')
                ->andWhere('vendorPricing.vendorCode = :vendorCode')
                ->andWhere(
                    $queryBuilder->expr()->in(
                        'variant.position',
                        str_replace(':product_id', 'o.id', $subQuery->getDQL()),
                    ),
                )
                ->setParameter('vendorCode', $vendor->getCode())
                ->setParameter('enabled', true)
            ;
        }

        return $queryBuilder;
    }

    public function findLatestProductByVendor(VendorInterface $vendor, string $locale, int $count): array
    {
        return $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere(':vendor MEMBER OF o.vendors')
            ->andWhere('o.enabled = :enabled')
            ->addOrderBy('o.createdAt', 'DESC')
            ->setParameter('vendor', $vendor)
            ->setParameter('locale', $locale)
            ->setParameter('enabled', true)
            ->setMaxResults($count)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findOneByVendorAndSlug(VendorInterface $vendor, string $locale, string $slug): ?ProductPropertyInterface
    {
        $product = $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere('translation.slug = :slug')
            ->andWhere(':vendor MEMBER OF o.vendors')
            ->andWhere('o.enabled = :enabled')
            ->setParameter('vendor', $vendor)
            ->setParameter('locale', $locale)
            ->setParameter('slug', $slug)
            ->setParameter('enabled', true)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        $this->associationHydrate->hydrateAssociations($product, [
            'images',
            'options',
            'options.translations',
            'variants',
            'variants.vendorPricings',
            'variants.optionValues',
            'variants.optionValues.translations',
        ]);

        return $product;
    }

    public function findOneByVendorAndCode(VendorInterface $vendor, string $code): ?ProductPropertyInterface
    {
        $product = $this->createQueryBuilder('o')
            ->where('o.code = :code')
            ->andWhere(':vendor MEMBER OF o.vendors')
            ->andWhere('o.enabled = :enabled')
            ->setParameter('vendor', $vendor)
            ->setParameter('code', $code)
            ->setParameter('enabled', true)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        $this->associationHydrate->hydrateAssociations($product, [
            'images',
            'options',
            'options.translations',
            'variants',
            'variants.vendorPricings',
            'variants.optionValues',
            'variants.optionValues.translations',
        ]);

        return $product;
    }

    public function findOneByCode(string $code): ?ProductPropertyInterface
    {
        return $this->createQueryBuilder('o')
            ->where('o.code = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findByTaxation(TaxationInterface $taxon): array
    {
        return $this
            ->createQueryBuilder('product')
            ->distinct()
            ->addSelect('productTaxation')
            ->innerJoin('product.productTaxations', 'productTaxation')
            ->andWhere('productTaxation.taxon = :taxon')
            ->setParameter('taxon', $taxon)
            ->getQuery()
            ->getResult()
            ;
    }
}
