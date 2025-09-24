<?php
namespace App\Repository\Role;

use App\Entity\Role\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RolePermissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Role::class);
    }

    public function findPermissionsByRole(string $role): array
    {
        return array_map(
            fn(Role $rp) => $rp->getPermission(),
            $this->findBy(['role' => $role])
        );
    }

    public function findAllPermissions(): array
    {
        $all = $this->findAll();
        $result = [];
        foreach ($all as $rp) {
            $result[$rp->getRole()][] = $rp->getPermission();
        }
        return $result;
    }
}
