<?php
	declare(strict_types=1);

	namespace App\Repository\Vendor;

	use App\Entity\Vendor\Vendors;
	use App\Entity\Vendor\VendorsMediaAttachments;
	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
	use Symfony\Bridge\Doctrine\RegistryInterface;

	/**
	 * @method VendorsMediaAttachments|null find($id, $lockMode = null, $lockVersion = null)
	 * @method VendorsMediaAttachments|null findOneBy(array $criteria, array $orderBy = null)
	 * @method VendorsMediaAttachments[]    findAll()
	 * @method VendorsMediaAttachments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	 */
	class VendorsMediaAttachmentsRepository
		extends ServiceEntityRepository
	{
		public function __construct(RegistryInterface $registry)
		{
			parent::__construct($registry, VendorsMediaAttachments::class);
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
