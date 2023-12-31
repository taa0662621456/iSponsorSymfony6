<?php

namespace App\Repository\Vendor;

use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorEnUS;
use App\Entity\Vendor\VendorIban;
use App\Repository\EntityRepository;
use App\Entity\Vendor\VendorDocumentAttachment;
use App\Entity\Vendor\VendorFavourite;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Security\Core\User\UserInterface;
use App\RepositoryInterface\Vendor\VendorRepositoryInterface;

/**
 * @method Vendor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vendor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vendor[]    findAll()
 * @method Vendor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendorRepository extends EntityRepository implements VendorRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vendor::class);
    }

    public function findActiveVendorById($vendorId): VendorIban|Vendor|VendorDocumentAttachment|VendorEnUS|VendorFavourite|null
    {
        return $this->findOneBy([
            'id' => (int) $vendorId,
            'iaActive' => true,
        ]);
    }

    public function findActiveVendorByApiToken($vendorId): VendorIban|Vendor|VendorDocumentAttachment|VendorEnUS|VendorFavourite|null
    {
        return $this->findOneBy([
            'apiToken' => $vendorId,
            'isActive' => true,
        ]);
    }

    public function setIsActive(bool $true)
    {
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findOneByEmail(string $email): ?UserInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.emailCanonical = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
