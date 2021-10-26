<?php
	declare(strict_types=1);

	namespace App\Repository\Product;


	use App\Entity\Product\ProductAttachment;
	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
	use Doctrine\Persistence\ManagerRegistry;

	/**
	 * @method ProductAttachment|null find($id, $lockMode = null, $lockVersion = null)
	 * @method ProductAttachment|null findOneBy(array $criteria, array $orderBy = null)
	 * @method ProductAttachment[]    findAll()
	 * @method ProductAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	 */
	class ProductAttachmentRepository extends ServiceEntityRepository
	{
		public function __construct(ManagerRegistry $registry)
		{
			parent::__construct($registry, ProductAttachment::class);
		}
	}
