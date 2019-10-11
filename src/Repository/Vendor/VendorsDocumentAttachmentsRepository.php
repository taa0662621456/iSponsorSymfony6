<?php
	declare(strict_types=1);

	namespace App\Repository\Vendor;

	use App\Entity\Vendor\VendorsDocumentAttachments;
	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
	use Symfony\Bridge\Doctrine\RegistryInterface;

	/**
	 * @method VendorsDocumentAttachments|null find($id, $lockMode = null, $lockVersion = null)
	 * @method VendorsDocumentAttachments|null findOneBy(array $criteria, array $orderBy = null)
	 * @method VendorsDocumentAttachments[]    findAll()
	 * @method VendorsDocumentAttachments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	 */
	class VendorsDocumentAttachmentsRepository
		extends ServiceEntityRepository
	{
		public function __construct(RegistryInterface $registry)
		{
			parent::__construct($registry, VendorsDocumentAttachments::class);
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
