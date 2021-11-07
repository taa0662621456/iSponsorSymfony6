<?php

namespace App\DataFixtures;

use App\Entity\Vendor\Vendors;
use App\Entity\Vendor\VendorsDocumentAttachments;
use App\Entity\Vendor\VendorsEnGb;
use App\Entity\Vendor\VendorsIban;
use App\Entity\Vendor\VendorsMediaAttachments;
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

        $vendor = new Vendors();
        $vendorSecurity = new VendorSecurity();
        $vendorIban = new VendorsIban();
        $vendorEnGb = new VendorsEnGb();
        $vendorDocumentAttachments = new VendorsDocumentAttachments();
        $vendorMediaAttachments = new VendorsMediaAttachments();
        $uuid = $slug = Uuid::v4();

        try {
			$vendor->setUuid($uuid);
			$vendor->setSlug($slug);

            $vendorSecurity->setUuid($uuid);
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

        $vendorDocumentAttachments->setFileName('cover.jpg');
        $vendorDocumentAttachments->setFilePath('/');
        $vendorDocumentAttachments->setAttachment($vendor);

        $vendorMediaAttachments->setFileName('cover.jpg');
        $vendorMediaAttachments->setFilePath('/');
        $vendorMediaAttachments->setAttachment($vendor);

		$vendor->setVendorEnGb($vendorEnGb);
		$vendor->setVendorSecurity($vendorSecurity);
		$vendor->setVendorIban($vendorIban);

		$manager->persist($vendorDocumentAttachments);
		$manager->persist($vendorMediaAttachments);
		$manager->persist($vendorIban);
		$manager->persist($vendorEnGb);
		$manager->persist($vendorSecurity);
		$manager->persist($vendor);
		$manager->flush();
	}

	/**
	 * @return int
	 */
	public function getOrder()
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

