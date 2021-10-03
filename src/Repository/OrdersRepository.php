<?php

namespace App\Repository;

use App\Entity\Order\Orders;
use App\Entity\Project\Projects;

use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Laminas\Code\Generator\DocBlock\Tag;

/**
 * @method Orders|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orders|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orders[]    findAll()
 * @method Orders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersRepository extends ServiceEntityRepository
{
    /**
     * ProjectsRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orders::class);
    }

    /**
     * @param int $page
     * @param Tag|null $tag
     * @return Paginator
     */
    public function findLatest(int $page = 1, $tag = null): Paginator
    {

        $qb = $this->createQueryBuilder('p')
            ->addSelect('a', 't')
            ->innerJoin('p.vendorId', 'a')
            ->leftJoin('p.tags', 't')
            ->where('p.createdAt <= :now')
            ->orderBy('p.createdAt', 'DESC')
            ->setParameter('now', new DateTime())
        ;

        if (null !== $tag) {
            $qb->andWhere(':tag MEMBER OF p.tags')
                ->setParameter('tag', $tag);
        }
        return (new Paginator($qb))->paginate($page);

    }

    /**
     * @param string $rawQuery
     * @param int $limit
     * @return Projects[]
     */
    public function findBySearchQuery(string $rawQuery, int $limit = Orders::NUM_ITEMS): array
    {

        $query = $this->sanitizeSearchQuery($rawQuery);
        $searchTerms = $this->extractSearchTerms($query);
        if (0 === \count($searchTerms)) {
            return [];
        }
        $queryBuilder = $this->createQueryBuilder('p');
        foreach ($searchTerms as $key => $term) {
            $queryBuilder
                ->orWhere('p.name LIKE :t_'.$key)
                ->setParameter('t_'.$key, '%'.$term.'%')
            ;
        }
        return $queryBuilder
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }


    /**
     * Removes all non-alphanumeric characters except whitespaces.
     * @param string $query
     * @return string
     */
    private function sanitizeSearchQuery(string $query): string
    {
        return trim(preg_replace('/[[:space:]]+/', ' ', $query));
    }

    /**
     * Splits the search query into terms and removes the ones which are irrelevant.
     * @param string $searchQuery
     * @return array
     */
    private function extractSearchTerms(string $searchQuery): array
    {
        $terms = array_unique(explode(' ', $searchQuery));
        return array_filter($terms, static function ($term) {
            return 2 <= mb_strlen($term);
        });
    }


    // /**
    //  * @return Orders[] Returns an array of Orders objects
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
    public function findOneBySomeField($value): ?Orders
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}
