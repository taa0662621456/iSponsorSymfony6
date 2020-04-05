<?php
	declare(strict_types=1);

	namespace App\Repository\Project;


	use App\Entity\Project\ProjectsAttachments;
	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
	use Doctrine\Persistence\ManagerRegistry;

	/**
	 * @method ProjectsAttachments|null find($id, $lockMode = null, $lockVersion = null)
	 * @method ProjectsAttachments|null findOneBy(array $criteria, array $orderBy = null)
	 * @method ProjectsAttachments[]    findAll()
	 * @method ProjectsAttachments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	 */
	class ProjectsAttachmentsRepository extends ServiceEntityRepository
	{
		public function __construct(ManagerRegistry $registry)
		{
			parent::__construct($registry, ProjectsAttachments::class);
		}
	}
