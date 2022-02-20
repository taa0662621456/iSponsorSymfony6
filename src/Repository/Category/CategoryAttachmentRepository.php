<?php


	namespace App\Repository\Category;

	use App\Entity\Category\CategoryAttachment;
	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
	use Doctrine\Persistence\ManagerRegistry;

	/**
	 * @method CategoryAttachment|null find($id, $lockMode = null, $lockVersion = null)
	 * @method CategoryAttachment|null findOneBy(array $criteria, array $orderBy = null)
	 * @method CategoryAttachment[]    findAll()
	 * @method CategoryAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	 */
	class CategoryAttachmentRepository extends ServiceEntityRepository
	{
		public function __construct(ManagerRegistry $registry)
		{
			parent::__construct($registry, CategoryAttachment::class);
		}
	}
