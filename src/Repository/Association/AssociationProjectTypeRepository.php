<?php

namespace App\Repository\Association;

use Doctrine\ORM\QueryBuilder;
use App\Repository\EntityRepository;
use App\Entity\Association\AssociationProjectType;
use App\RepositoryInterface\Association\AssociationProjectTypeRepositoryInterface;

/**
 * @method AssociationProjectType|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociationProjectType|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociationProjectType[]    findAll()
 * @method AssociationProjectType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationProjectTypeRepository extends EntityRepository implements AssociationProjectTypeRepositoryInterface
{
    public function createListQueryBuilder(string $locale): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation')
            ->andWhere('translation.locale = :locale')
            ->setParameter('locale', $locale);
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
}
