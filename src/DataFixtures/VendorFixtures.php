<?php

namespace App\DataFixtures;

use App\Entity\Vendor\Vendor;
use App\Service\ThisPersonDoesNotExistPhotoConsumer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\Collections\ArrayCollection;
use Faker\Factory;


class VendorFixtures extends Fixture implements DependentFixtureInterface
{
    public const VENDOR_COLLECTION = 'vendorCollection';

    public function load(ObjectManager $manager)
	{
//        $vendorEnGbCollection = $this->getReference(VendorEnGbFixtures::VENDOR_ENGB_COLLECTION);
//        $vendorIbanCollection = $this->getReference(VendorIbanFixtures::VENDOR_IBAN_COLLECTION);
//        $vendorMediaCollection = $this->getReference(VendorMediaFixtures::VENDOR_MEDIA_COLLECTION);
//        $vendorDocumentCollection = $this->getReference(VendorDocumentFixtures::VENDOR_DOCUMENT_COLLECTION);
        $vendorSecurityCollection = $this->getReference(VendorSecurityFixtures::VENDOR_SECURITY_COLLECTION);
//        #
//        dd($this);

        $faker = Factory::create();

        $vendorCollection = new ArrayCollection();

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


        for ($p = 1; $p <= 10; $p++) {

            $personPhoto = new ThisPersonDoesNotExistPhotoConsumer();
            $randName = random_int(1000000, 1000000000);
            $personPhoto->getExitPersonPhoto((string)$randName);

            $vendor = new Vendor();

            #
            $vendor->setVendorIban($vendorIban);
            $vendor->setVendorIban($faker->randomElement($vendorIbanCollection));
            #
            $vendor->setVendorEnGb($vendorEnGb);
            #
            $vendor->setVendorSecurity($faker->randomElement($vendorSecurityCollection));
            #
            $manager->persist($vendor);
            $manager->flush();

            $vendorCollection->add($vendor);
        }

        $this->addReference(self::VENDOR_COLLECTION, $vendorCollection);
    }

    public function getDependencies (): array
    {
        return [
            VendorMediaFixtures::class,
            VendorDocumentFixtures::class,
            VendorEnGbFixtures::class,
            VendorIbanFixtures::class,
            VendorSecurityFixtures::class
        ];
    }

    public function getOrder(): int
    {
		return 6;
	}

	public static function getGroups(): array
	{
		return ['vendor'];
	}

}

