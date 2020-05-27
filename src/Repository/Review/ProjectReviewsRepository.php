<?php


namespace App\Repository\Review;


use App\Entity\Review\ProjectReviews;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method ProjectReviews|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectReviews|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectReviews[]    findAll()
 * @method ProjectReviews[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectReviewsRepository extends ServiceEntityRepository
{
    public const DAYS_BEFORE_REJECTED_REMOVAL = 7;
    public const REVIEWS_PER_PAGE = 10;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectReviews::class);
    }

    public function getReviewsPerPage(ProjectReviews $projectReviews, int $offset): Paginator
    {
        $qb = $this->createQueryBuilder('r')
            ->andWhere('r.slug = :product')
            ->setParameter('product', $projectReviews)
            ->orderBy('r.createdAt', 'DESC')
            ->setMaxResults(self::REVIEWS_PER_PAGE)
            ->setFirstResult($offset)
            ->getQuery();

        return new Paginator($qb);

    }


    public function deleteOldRejectedReviews()
    {
        return $this->getOldRejectedReviewsQueryBuilder()->delete()->getQuery()->execute();
    }

    public function countOldRejected(): int
    {
        return $this->getOldRejectedReviewsQueryBuilder()->select('COUNT(r.id)')->getQuery()->getSingleScalarResult();
    }

    public function getOldRejectedReviewsQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.state = :state_rejected or r.state = :state_spam')
            ->andWhere('r.createdAt < :date')
            ->setParameters([
                'state_rejected' => 'rejected',
                'state_spam' => 'spam',
                'date' => new \DateTime(-self::DAYS_BEFORE_REJECTED_REMOVAL),
            ]);
    }
}
