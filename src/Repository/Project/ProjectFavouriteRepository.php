<?php

namespace App\Repository\Project;

use App\Entity\Project\ProjectFavourite;
use App\Entity\Vendor\VendorFavourite;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectFavourite|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectFavourite|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectFavourite[]    findAll()
 * @method ProjectFavourite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectFavouriteRepository extends EntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectFavourite::class);
    }
    /**
     * @param VendorFavourite $vendor
     * @param integer $projectId
     *
     * @return bool|null
     * @throws NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
	public function checkIsLiked(VendorFavourite $vendor, int $projectId): ?bool
	{
		$qb = $this->getEntityManager()
			->createQueryBuilder()
			->select('count(f.id)')
			->from(ProjectFavourite::class, 'f')
			->innerJoin('f.createBy', 'v')
			->innerJoin('f.project', 'p')
			->where('v = :createBy')
			->andWhere('p.id = :project_id')
			->setParameters([
				'project_id' => $projectId,
				'vendor' => $vendor
			]);

		if ($qb->getQuery()->getSingleScalarResult()) {
			return true;
		}

		return false;
	}
}
