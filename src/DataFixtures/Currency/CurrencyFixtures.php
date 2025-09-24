<?php

namespace App\DataFixtures\Currency;

use App\Entity\Currency\Currency;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class CurrencyFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (['USD', 'EUR'] as $code) {
            $cur = new Currency();
            $cur->setCode($code);
            $manager->persist($cur);
            $this->addReference('currency_' . $code, $cur);
        }
        $manager->flush();
    }

    public static function getGroup(): string { return 'core'; }
    public static function getPriority(): int { return 6; }
}
