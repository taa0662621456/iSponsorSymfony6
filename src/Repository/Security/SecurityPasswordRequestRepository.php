<?php
namespace App\Repository\Security;

use App\Entity\Security\SecurityPasswordRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SecurityPasswordRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $r) { parent::__construct($r, SecurityPasswordRequest::class); }

    public function invalidateAllForUser(int $userId): void
    {
        $this->_em->createQuery('UPDATE App\Entity\Security\PasswordResetRequest r SET r.published = false WHERE r.user = :u AND r.usedAt IS NULL')
            ->setParameter('u', $userId)->execute();
    }
}