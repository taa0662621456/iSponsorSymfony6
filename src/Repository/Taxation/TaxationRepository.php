<?php

namespace App\Repository\Taxation;

use App\EntityInterface\Taxation\TaxationInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Taxation\Taxation;
use App\Repository\EntityRepository;

use App\RepositoryInterface\Taxation\TaxationRepositoryInterface;

/**
 * @method Taxation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Taxation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Taxation[]    findAll()
 * @method Taxation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaxationRepository extends EntityRepository implements TaxationRepositoryInterface
{
    public function findChildren(string $parentCode, string $locale = null): array
    {
        return $this->createTranslationBasedQueryBuilder($locale)
            ->addSelect('child')
            ->innerJoin('o.parent', 'parent')
            ->leftJoin('o.children', 'child')
            ->andWhere('parent.code = :parentCode')
            ->addOrderBy('o.position')
            ->setParameter('parentCode', $parentCode)
            ->getQuery()
            ->getResult();
    }

    public function findChildrenByChannelMenuTaxon(TaxationInterface $menuTaxon = null, string $locale = null): array
    {
        return $this->createTranslationBasedQueryBuilder($locale)
            ->addSelect('child')
            ->innerJoin('o.parent', 'parent')
            ->leftJoin('o.children', 'child')
            ->andWhere('o.enabled = :enabled')
            ->andWhere('parent.code = :parentCode')
            ->addOrderBy('o.position')
            ->setParameter('parentCode', (null !== $menuTaxon) ? $menuTaxon->getCode() : 'category')
            ->setParameter('enabled', true)
            ->getQuery()
            ->getResult();
    }

    public function findOneBySlug(string $slug, string $locale): ?TaxationInterface
    {
        try {
            return $this->createQueryBuilder('o')
                ->addSelect('translation')
                ->innerJoin('o.translations', 'translation')
                ->andWhere('o.enabled = :enabled')
                ->andWhere('translation.slug = :slug')
                ->andWhere('translation.locale = :locale')
                ->setParameter('slug', $slug)
                ->setParameter('locale', $locale)
                ->setParameter('enabled', true)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            throw $e;
        }
    }

    public function findByName(string $name, string $locale): array
    {
        return $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->innerJoin('o.translations', 'translation')
            ->andWhere('translation.name = :name')
            ->andWhere('translation.locale = :locale')
            ->setParameter('name', $name)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult();
    }

    public function findRootNodes(): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.parent IS NULL')
            ->addOrderBy('o.position')
            ->getQuery()
            ->getResult();
    }

    public function findByNamePart(string $phrase, string $locale = null, int $limit = null): array
    {
        /** @var TaxationInterface[] $results */
        $results = $this->createTranslationBasedQueryBuilder($locale)
            ->andWhere('translation.name LIKE :name')
            ->setParameter('name', '%'.$phrase.'%')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();

        foreach ($results as $result) {
            $result->setFallbackLocale(array_key_first($result->getTranslations()->toArray()));
        }

        return $results;
    }

    public function createListQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('o')->leftJoin('o.translations', 'translation');
    }

    protected function createTranslationBasedQueryBuilder(?string $locale): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->leftJoin('o.translations', 'translation');

        if (null !== $locale) {
            $queryBuilder
                ->andWhere('translation.locale = :locale')
                ->setParameter('locale', $locale);
        }

        return $queryBuilder;
    }
}
