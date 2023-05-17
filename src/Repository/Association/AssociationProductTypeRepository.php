<?php

namespace App\Repository\Association;

use App\Entity\Association\AssociationProductType;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Association\AssociationProductTypeRepositoryInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssociationProductType|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssociationProductType|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssociationProductType[]    findAll()
 * @method AssociationProductType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssociationProductTypeRepository extends EntityRepository implements AssociationProductTypeRepositoryInterface
{

    public function createListQueryBuilder(string $locale): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation')
            ->andWhere('translation.locale = :locale')
            ->setParameter('locale', $locale)
        ;
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
            ->getResult()
        ;
    }
}
