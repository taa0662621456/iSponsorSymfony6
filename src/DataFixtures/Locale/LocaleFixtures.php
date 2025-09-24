<?php

namespace App\DataFixtures\Locale;

use App\Entity\Locale\Locale;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class LocaleFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (['en_US', 'de_DE', 'fr_FR'] as $locale) {
            $loc = new Locale();
            $loc->setCode($locale);

            $manager->persist($loc);
            $this->addReference('locale_' . $locale, $loc);
        }

        $manager->flush();
    }

    public static function getGroup(): string { return 'core'; }
    public static function getPriority(): int { return 5; }
}