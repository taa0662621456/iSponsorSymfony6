<?php

	namespace App\Repository;

	use App\Entity\Order\OrdersStatus;

	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
	use Doctrine\Persistence\ManagerRegistry;

	/**
	 * @method OrdersStatus|null find($id, $lockMode = null, $lockVersion = null)
	 * @method OrdersStatus|null findOneBy(array $criteria, array $orderBy = null)
	 * @method OrdersStatus[]    findAll()
	 * @method OrdersStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	 */
	class OrdersStatusRepository extends ServiceEntityRepository
	{
		/**
		 * @param RegistryInterface $registry
		 */
		public function __construct(ManagerRegistry $registry)
		{
			parent::__construct($registry, OrdersStatus::class);
		}


		// /**
		//  * @return Orders[] Returns an array of Orders objects
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
		public function findOneBySomeField($value): ?Orders
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
