<?php

namespace App\DataFixtures\Menu;

use App\Entity\Menu\MenuItem;
use App\Entity\Module\Module;
use App\Entity\Module\ModuleMenu;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class MenuFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $module = new Module();
        $module->setFirstTitle('Core');
        $manager->persist($module);

        $menu = new MenuItem();
        $menu->setFirstTitle('Dashboard');
        $manager->persist($menu);

        $moduleMenu = new ModuleMenu();
        $moduleMenu->setModule($module);
        $moduleMenu->setMenuItem($menu);
        $manager->persist($moduleMenu);

        $this->addReference('module_core', $module);
        $this->addReference('menu_dashboard', $menu);

        $manager->flush();
    }

    public static function getGroup(): string { return 'menu'; }
    public static function getPriority(): int { return 10; }
}
