<?php
	declare(strict_types=1);

	namespace App\Repository\Vendor;

	use App\Entity\Vendor\VendorsSecurity;
	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
	use Doctrine\Common\Persistence\ManagerRegistry;

	/**
	 * @method VendorsSecurity|null find($id, $lockMode = null, $lockVersion = null)
	 * @method VendorsSecurity|null findOneBy(array $criteria, array $orderBy = null)
	 * @method VendorsSecurity[]    findAll()
	 * @method VendorsSecurity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	 */
	class VendorsSecurityRepository
		extends ServiceEntityRepository
	{
		public function __construct(ManagerRegistry $registry)
		{
			parent::__construct($registry, VendorsSecurity::class);
		}

		// /**
		//  * @return Vendors[] Returns an array of VendorsSecurity objects
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
		public function findOneBySomeField($value): ?VendorsSecurity
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
