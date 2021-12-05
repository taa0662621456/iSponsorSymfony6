<?php

namespace App\DataFixtures;

use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorDocument;
use App\Entity\Vendor\VendorEnGb;
use App\Entity\Vendor\VendorIban;
use App\Entity\Vendor\VendorMedia;
use App\Entity\Vendor\VendorSecurity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Symfony\Component\Uid\Uuid;

class VendorsFixtures extends Fixture
{

	public function load(ObjectManager $manager)
	{
        $rand = rand(0, 999999);
        $password = $rand;
        //$password = md5($rand);

        $vendor = new Vendor();
        $vendorSecurity = new VendorSecurity();
        $vendorIban = new VendorIban();
        $vendorEnGb = new VendorEnGb();
        $vendorDocument = new VendorDocument();
        $vendorMedia = new VendorMedia();
        $uuid = $slug = Uuid::v4();

        try {
			$vendor->setSlug($slug);
            $vendorSecurity->setSlug($uuid);
        } catch (Exception $e) {
        }


        $vendorSecurity->setEmail('taa0' . $rand . '@gmail.com');
        $vendorSecurity->setPassword($password);

        $vendorEnGb->setVendorZip($rand);
//        $vendorEnGb->setFirstTitle('VendorFT' . $rand);
//        $vendorEnGb->setFirstTitle('VendorMT' . $rand);
//        $vendorEnGb->setFirstTitle('VendorLT' . $rand);
//        //TODO: тут я хочу унифицировать три Titles и перенести их в BaseTrait, т.к. эти три поля так или иначе
// присущий всем типам объектов

        $vendorIban->setIban('0000000000000000');

        $vendorDocument->setFileName('cover.jpg');
        $vendorDocument->setFilePath('/');
        $vendorDocument->setAttachment($vendor);

        $vendorMedia->setFileName('cover.jpg');
        $vendorMedia->setFilePath('/');
        $vendorMedia->setAttachment($vendor);

		$vendor->setVendorEnGb($vendorEnGb);
		$vendor->setVendorSecurity($vendorSecurity);
		$vendor->setVendorIban($vendorIban);

		$manager->persist($vendorDocument);
		$manager->persist($vendorMedia);
		$manager->persist($vendorIban);
		$manager->persist($vendorEnGb);
		$manager->persist($vendorSecurity);
		$manager->persist($vendor);
		$manager->flush();
	}

	/**
	 * @return int
	 */
	public function getOrder(): int
    {
		return 1;
	}

	/**
	 * @return string[]
	 */
	public static function getGroups(): array
	{
		return ['vendors'];
	}
}

