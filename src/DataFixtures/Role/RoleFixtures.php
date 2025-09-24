<?php

namespace App\DataFixtures\Role;

use App\Entity\Role\Role;
use App\Enum\OrderPermissionEnum;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class RoleFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $matrix = [
            'ROLE_ADMIN' => [
                OrderPermissionEnum ::VIEW,
                OrderPermissionEnum ::EDIT,
                OrderPermissionEnum ::DELETE,
                OrderPermissionEnum ::CANCEL,
                OrderPermissionEnum ::REFUND,
                OrderPermissionEnum ::PAY,
            ],
            'ROLE_MANAGER' => [
                OrderPermissionEnum ::VIEW,
                OrderPermissionEnum ::EDIT,
                OrderPermissionEnum ::DELETE,
                OrderPermissionEnum ::CANCEL,
                OrderPermissionEnum ::REFUND,
            ],
            'ROLE_VENDOR' => [
                OrderPermissionEnum ::VIEW,
                OrderPermissionEnum ::EDIT,
                OrderPermissionEnum ::DELETE,
                OrderPermissionEnum ::CANCEL,
                OrderPermissionEnum ::REFUND,
            ],
            'ROLE_CUSTOMER' => [
                OrderPermissionEnum ::VIEW,
                OrderPermissionEnum ::EDIT,
                OrderPermissionEnum ::CANCEL,
                OrderPermissionEnum ::PAY,
            ],
        ];

        foreach ($matrix as $role => $permissions) {
            foreach ($permissions as $permission) {
                $rp = new Role();
                $rp->setRole($role);
                $rp->setPermission($permission->value); // enum → string
                $manager->persist($rp);
            }
        }


        foreach (['ROLE_USER', 'ROLE_ADMIN'] as $name) {
            $role = new Role();
            $role->setName($name);
            $manager->persist($role);
            $this->addReference('role_' . $name, $role);
        }
        $manager->flush();
    }

    public static function getGroup(): string { return 'core'; }
    public static function getPriority(): int { return 4; }
}
