<?php
	declare(strict_types=1);

	namespace App\Repository\Category;

	use App\Entity\Category\CategoriesAttachments;
	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
	use Symfony\Bridge\Doctrine\RegistryInterface;

	/**
	 * @method CategoriesAttachments|null find($id, $lockMode = null, $lockVersion = null)
	 * @method CategoriesAttachments|null findOneBy(array $criteria, array $orderBy = null)
	 * @method CategoriesAttachments[]    findAll()
	 * @method CategoriesAttachments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	 */
	class CategoriesAttachmentsRepository extends ServiceEntityRepository
	{
		public function __construct(RegistryInterface $registry)
		{
			parent::__construct($registry, CategoriesAttachments::class);
		}
	}
