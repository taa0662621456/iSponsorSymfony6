<?php

namespace App\DataFixtures;

use App\Entity\Vendor\VendorSecurity;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class VendorSecurityFixtures extends AbstractDataFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++){

            $vendorSecurity = new VendorSecurity();
            #
            $vendorSecurity->setEmail($faker->email);
            #
            $vendorSecurity->setLocale($faker->locale);
            $vendorSecurity->setPassword($faker->password(8,12));
            $vendorSecurity->setPhone($faker->phoneNumber);
            $vendorSecurity->setPublished(true);
            $vendorSecurity->setRoles(['ROLE_USER']);
            #
            $manager->persist($vendorSecurity);

            $this->addReference('vendorSecurity_' . $i, $vendorSecurity);
        }
        $manager->flush();
        $manager->clear();

    }

    public function getDependencies(): array
    {
        return [
            BaseEmptyFixtures::class,
            #
            VendorMediaFixtures::class,
            VendorDocumentFixtures::class,
        ];
    }

    public function getOrder(): int
    {
        return 4;
    }


    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['vendor'];
    }

}
