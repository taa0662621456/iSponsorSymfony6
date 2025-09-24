<?php
namespace App\Repository\Security;

use App\Entity\Security\SecuritySmsCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SecuritySmsCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $r) { parent::__construct($r, SmsCode::class); }

    public function findActiveByPhone(string $phone): ?SecuritySmsCode
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.phone = :p')->setParameter('p', $phone)
            ->andWhere('s.expiresAt > :now')->setParameter('now', new \DateTimeImmutable())
            ->orderBy('s.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()->getOneOrNullResult();
    }
}
