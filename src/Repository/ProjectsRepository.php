<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Project\Projects;
use App\Entity\Project\ProjectsTags;
use App\Pagination\Paginator;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Exception;
use phpDocumentor\Reflection\Project;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Projects|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projects|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projects[]    findAll()
 * @method Projects[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectsRepository extends ServiceEntityRepository
{
    /**
     * ProjectsRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Projects::class);
    }

    /**
     * @param int $page
     * @param ProjectsTags|null $tag
     * @return Paginator
     * @throws Exception
     */
    public function findLatest(int $page = 1, ProjectsTags $tag = null): Paginator
    {
        $qb = $this->createQueryBuilder('p')
            ->addSelect('a', 't')
            ->innerJoin('p.vendorId', 'a')
            ->leftJoin('p.tags', 't')
            //->where('p.createdAt <= :now')
            //->orderBy('p.createdAt', 'DESC')
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
     * @return Project[]
     */
    public function findBySearchQuery(string $rawQuery, int $limit = Projects::NUM_ITEMS): array
    {
        $query = $this->sanitizeSearchQuery($rawQuery);
        $searchTerms = $this->extractSearchTerms($query);
        if (0 === \count($searchTerms)) {
            return [];
        }
        $queryBuilder = $this->createQueryBuilder('p');
        foreach ($searchTerms as $key => $term) {
            $queryBuilder
                ->orWhere('p.title LIKE :t_'.$key)
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

    /**
     * @param string $query
     * @return mixed
     */
    public function searchByQuery(string $query)
    {
        return $this->createQueryBuilder('p')
            ->where('p.projectTitle LIKE :query')
            ->setParameter('query', '%'. $query. '%')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Projects[] Returns an array of Projects objects
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
    public function findOneBySomeField($value): ?Projects
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
