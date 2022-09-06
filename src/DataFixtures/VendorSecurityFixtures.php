<?php

namespace App\DataFixtures;

use App\Entity\Vendor\VendorSecurity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VendorSecurityFixtures extends Fixture implements DependentFixtureInterface
{
    public const VENDOR_SECURITY_COLLECTION = 'vendorSecurityCollection';

    public function load(ObjectManager $manager)
    {

        $vendorSecurityCollection = new ArrayCollection();

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
            $manager->flush();
            #
            $vendorSecurityCollection->add($vendorSecurity);
        }

        $this->addReference(self::VENDOR_SECURITY_COLLECTION, $vendorSecurityCollection);
    }

    public function getDependencies(): array
    {
        return [
            VendorDocumentFixtures::class,
            VendorEnGbFixtures::class,
            VendorIbanFixtures::class,
            VendorMediaFixtures::class,
        ];
    }

    public function getOrder(): int
    {
        return 5;
    }


    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['vendor'];
    }

}
