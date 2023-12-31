<?php

namespace App\Repository\Vendor;

use App\Repository\EntityRepository;
use App\Entity\Vendor\VendorSecurity;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Security\Core\User\UserInterface;
use App\RepositoryInterface\Vendor\VendorSecurityRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * @method VendorSecurity|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorSecurity|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorSecurity[]    findAll()
 * @method VendorSecurity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorSecurityRepository extends EntityRepository implements VendorSecurityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VendorSecurity::class);
    }

                /**
                 * Used to upgrade (rehash) the user's password automatically over time.
                 */
                public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
                {
                    if (!$user instanceof VendorSecurity) {
                        throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
                    }

                    $user->setPassword($newEncodedPassword);
                    $this->_em->persist($user);
                    $this->_em->flush();
                }

    // /**
    //  * @return Vendors[] Returns an array of VendorSecurity objects
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
            ->getOneOrNullResult();
    }
}
