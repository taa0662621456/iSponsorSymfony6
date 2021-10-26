<?php
	declare(strict_types=1);

	namespace App\Repository\Vendor;

	use App\Entity\Vendor\VendorSecurity;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Doctrine\ORM\NonUniqueResultException;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Doctrine\Persistence\ManagerRegistry;
    use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
    use Symfony\Component\Security\Core\User\UserInterface;

    /**
     * @method VendorSecurity|null find($id, $lockMode = null, $lockVersion = null)
     * @method VendorSecurity|null findOneBy(array $criteria, array $orderBy = null)
     * @method VendorSecurity[]    findAll()
     * @method VendorSecurity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
     */
    class VendorSecurityRepository extends ServiceEntityRepository
    {
        public function __construct(ManagerRegistry $registry)
        {
            parent::__construct($registry, VendorSecurity::class);
        }

        /**
         * Used to upgrade (rehash) the user's password automatically over time.
         * @param UserInterface $user
         * @param string $newEncodedPassword
         * @throws ORMException
         * @throws OptimisticLockException
         */
        public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
        {
            if (!$user instanceof VendorSecurity) {
                throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
            }

            $user->setPassword($newEncodedPassword);
            $this->_em->persist($user);
            $this->_em->flush();
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


        /**
         * @throws NonUniqueResultException
         */
        public function findOneBySomeField($value): ?VendorSecurity
		{
			return $this->createQueryBuilder('p')
				->andWhere('p.exampleField = :val')
				->setParameter('val', $value)
				->getQuery()
				->getOneOrNullResult()
			;
		}

	}
