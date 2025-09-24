<?php
namespace App\Security;

use App\Entity\Security\RolePermission;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PermissionChecker
{
    private array $cache = [];

    public function __construct(private EntityManagerInterface $em) {}

    public function hasPermission(UserInterface $user, string $permission): bool
    {
        foreach ($user->getRoles() as $role) {
            if (!isset($this->cache[$role])) {
                $this->cache[$role] = $this->em->getRepository(RolePermission::class)
                    ->createQueryBuilder('rp')
                    ->select('rp.permission')
                    ->where('rp.role = :role')
                    ->setParameter('role', $role)
                    ->getQuery()
                    ->getSingleColumnResult();
            }

            if (in_array($permission, $this->cache[$role], true)) {
                return true;
            }
        }

        return false;
    }
}
