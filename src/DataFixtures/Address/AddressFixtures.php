<?php

namespace App\DataFixtures\Address;

use App\Entity\Address\Address;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class AddressFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $addr = new Address();
        $addr->setFirstName('Default');
        $addr->setLastName('Address');
        $addr->setCountryCode('US');
        $addr->setCity('Houston');
        $addr->setStreet('Westheimer Rd 123');
        $addr->setPostcode('77001');
        $manager->persist($addr);

        $this->addReference('address_1', $addr);
        $manager->flush();
    }

    public static function getGroup(): string { return 'core'; }
    public static function getPriority(): int { return 7; }
}
