<?php

namespace App\DataFixtures;

use App\Entity\Vendor\VendorIban;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class VendorIbanFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $iban = new VendorIban();
            // Example: dummy IBAN
            $iban->setIban("DE89 3704 0044 0532 0130 0$i");

            $manager->persist($iban);
            $this->addReference('vendorIban_' . $i, $iban);
        }

        $manager->flush();
    }

    public static function getGroup(): string { return 'vendor'; }
    public static function getPriority(): int { return 30; }
}
