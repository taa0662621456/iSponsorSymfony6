<?php

namespace App\DataFixtures;

use App\Entity\Vendor\Vendor;
use App\Service\ThisPersonDoesNotExistPhotoConsumer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use \Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\DataFixtures\VendorSecurityFixtures;


final class VendorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
	{
        $faker = Factory::create();

//        $picsumPhotoApiConsumer = new PicsumPhotoApiConsumer();
//        $picsum = $picsumPhotoApiConsumer->getPicsum('GET', 'https://picsum.photos/v2/list')->toArray();
//
//        $picsum = array_rand($picsum);



//        $dir = dirname('public\\upload\\vendor\\image\\.');
//        $avatarArray = scandir($dir);
//
//        foreach ($avatarArray as $avatar){
//            if (!is_dir($avatar)){
//                $avatar = 'public/upload/vendor/image/' . $avatar;
//                unlink($avatar);
//            }
//        }


        for ($i = 1; $i <= 10; $i++) {

            $vendorMedia = $this->getReference('vendorMedia_' . $i);
            $vendorDocument = $this->getReference('vendorDocument_' . $i);
            $vendorEnGb = $this->getReference('vendorEnGb_' . $i);
            $vendorIban = $this->getReference('vendorIban_' . $i);
            $vendorSecurity = $this->getReference('vendorSecurity_' . $i);

            $personPhoto = new ThisPersonDoesNotExistPhotoConsumer();
            $randName = random_int(1000000, 1000000000);
            $personPhoto->getExitPersonPhoto((string)$randName);

            $vendor = new Vendor();
            #
            $vendor->setVendorIban($vendorIban);
            #
            $vendor->setVendorEnGb($vendorEnGb);
            #
            $vendor->setVendorSecurity($vendorSecurity);
            #
            $manager->persist($vendor);
            #
            $this->addReference('vendor_' . $i, $vendor);
        }
        $manager->flush();

    }

    public function getDependencies (): array
    {
        return [
            BaseEmptyFixtures::class,
            #
            VendorMediaFixtures::class,
            VendorDocumentFixtures::class,
            VendorSecurityFixtures::class,
            VendorIbanFixtures::class,
            VendorEnGbFixtures::class,
            #

        ];
    }

    public function getOrder(): int
    {
		return 7;
	}

	public static function getGroups(): array
	{
		return ['vendor'];
	}

}

