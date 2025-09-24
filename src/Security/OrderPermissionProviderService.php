<?php
namespace App\Security;

use App\Enum\OrderPermission;
use App\Repository\Security\RolePermissionRepository;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

final class OrderPermissionProvider
{
    public function __construct(
        private readonly RolePermissionRepository $repository,
        private readonly CacheInterface $cache
    ) {}

    public function getPermissionsForRole(string $role): array
    {
        return $this->cache->get("role_permissions_$role", function (ItemInterface $item) use ($role) {
            $item->expiresAfter(3600); // 1 час
            return $this->repository->findPermissionsByRole($role);
        });
    }

    public function getPermissionsForRoles(array $roles): array
    {
        $permissions = [];
        foreach ($roles as $role) {
            $permissions = array_merge($permissions, $this->getPermissionsForRole($role));
        }
        return array_unique($permissions);
    }

    public function validatePermissions(): void
    {
        $validPermissions = array_column(OrderPermission::cases(), 'value');
        foreach ($this->repository->findAllPermissions() as $role => $permissions) {
            foreach ($permissions as $p) {
                if (!in_array($p, $validPermissions, true)) {
                    throw new \RuntimeException(sprintf(
                        'Invalid permission "%s" for role "%s". Allowed: %s',
                        $p,
                        $role,
                        implode(', ', $validPermissions)
                    ));
                }
            }
        }
    }
}
