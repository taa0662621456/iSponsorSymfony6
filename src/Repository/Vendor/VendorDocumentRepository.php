<?php


	namespace App\Repository\Vendor;

	use App\Entity\Vendor\VendorDocument;
    use App\RepositoryInterface\Vendor\VendorDocumentRepositoryInterface;
    use App\Repository\EntityRepository;
	use Doctrine\Persistence\ManagerRegistry;

	/**
	 * @method VendorDocument|null find($id, $lockMode = null, $lockVersion = null)
	 * @method VendorDocument|null findOneBy(array $criteria, array $orderBy = null)
	 * @method VendorDocument[]    findAll()
	 * @method VendorDocument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	 */
	class VendorDocumentRepository
		extends EntityRepository implements VendorDocumentRepositoryInterface
	{
		public function __construct(ManagerRegistry $registry)
		{
			parent::__construct($registry, VendorDocument::class);
		}

		// /**
		//  * @return VendorsDocumentAttachments[] Returns an array of VendorsDocumentAttachments objects
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
		public function findOneBySomeField($value): ?VendorsDocumentAttachments
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
