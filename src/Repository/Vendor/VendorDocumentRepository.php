<?php

namespace App\Repository\Vendor;

use App\Repository\EntityRepository;
use App\Entity\Vendor\VendorDocumentAttachment;
use Doctrine\Persistence\ManagerRegistry;
use App\RepositoryInterface\Vendor\VendorDocumentRepositoryInterface;

/**
 * @method VendorDocumentAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorDocumentAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorDocumentAttachment[]    findAll()
 * @method VendorDocumentAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorDocumentRepository extends EntityRepository implements VendorDocumentRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VendorDocumentAttachment::class);
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
