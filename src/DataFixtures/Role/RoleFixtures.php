<?php

namespace App\DataFixtures\Role;

use App\Entity\Role\Role;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class RoleFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
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

