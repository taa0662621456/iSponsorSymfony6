<?php

	namespace App\Repository\Order;

	use App\Entity\Order\OrderStatus;

	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
	use Doctrine\Persistence\ManagerRegistry;

	/**
	 * @method OrderStatus|null find($id, $lockMode = null, $lockVersion = null)
	 * @method OrderStatus|null findOneBy(array $criteria, array $orderBy = null)
	 * @method OrderStatus[]    findAll()
	 * @method OrderStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	 */
	class OrderStatusRepository extends ServiceEntityRepository
	{
        /**
         * @param ManagerRegistry $registry
         */
		public function __construct(ManagerRegistry $registry)
		{
			parent::__construct($registry, OrderStatus::class);
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
