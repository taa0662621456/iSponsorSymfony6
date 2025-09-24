<?php


	namespace App\Repository\Vendor;

	use App\Entity\Vendor\Vendor;
	use App\Entity\Vendor\VendorMedia;
	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
	use Doctrine\Persistence\ManagerRegistry;

	/**
	 * @method VendorMedia|null find($id, $lockMode = null, $lockVersion = null)
	 * @method VendorMedia|null findOneBy(array $criteria, array $orderBy = null)
	 * @method VendorMedia[]    findAll()
	 * @method VendorMedia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	 */
	class VendorMediaRepository
		extends ServiceEntityRepository
	{
		public function __construct(ManagerRegistry $registry)
		{
			parent::__construct($registry, VendorMedia::class);
		}

        public function countByVendor(Vendor $vendor): int
        {
            return (int)$this->createQueryBuilder('m')
                ->select('COUNT(m.id)')
                ->andWhere('m.vendor = :vendor')
                ->setParameter('vendor', $vendor)
                ->getQuery()
                ->getSingleScalarResult();
        }

		// /**
		//  * @return VendorsMediaAttachments[] Returns an array of VendorsMediaAttachments objects
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
		public function findOneBySomeField($value): ?VendorsMediaAttachments
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