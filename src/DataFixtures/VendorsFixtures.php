<?php

namespace App\DataFixtures;

use App\Doctrine\UuidEncoder;
use App\Entity\Vendor\Vendors;
use App\Entity\Vendor\VendorsDocAttachments;
use App\Entity\Vendor\VendorsEnGb;
use App\Entity\Vendor\VendorsIban;
use App\Entity\Vendor\VendorsMediaAttachments;
use App\Entity\Vendor\VendorsSecurity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;
use Ramsey\Uuid\Uuid;

class VendorsFixtures extends Fixture
{

	public function load(ObjectManager $manager)
	{
		$rand = rand(0, 999999);
		$password = md5($rand);

		$vendor = new Vendors();
		$vendorSecurity = new VendorsSecurity();
		$vendorIban = new VendorsIban();
		$vendorEnGb = new VendorsEnGb();
		$vendorDocAttachments = new VendorsDocAttachments();
		$vendorMediaAttachments = new VendorsMediaAttachments();
		$slug = new UuidEncoder();

		try {
			$uuid = Uuid::uuid4();
			$vendor->setUuid($uuid);
			$vendor->setSlug($slug->encode($uuid));

			$vendorSecurity->setUuid($uuid);
			$vendorSecurity->setSlug($uuid);
		} catch (Exception $e) {
		}


		$vendorSecurity->setEmail('taa0' . $rand . '@gmail.com');
		$vendorSecurity->setPassword($password);

		$vendorEnGb->setVendorZip($rand);

		$vendorIban->setIban('0000000000000000');

		$vendorDocAttachments->setFile('cover.jpg');
		$vendorDocAttachments->setFilePath('/');
		$vendorDocAttachments->setVendorsDocsAttachments($vendor);

		$vendorMediaAttachments->setFile('cover.jpg');
		$vendorMediaAttachments->setFilePath('/');
		$vendorMediaAttachments->setVendorMediaAttachments($vendor);

		$vendor->setVendorEnGb($vendorEnGb);
		$vendor->setVendorSecurity($vendorSecurity);
		$vendor->setVendorIban($vendorIban);

		$manager->persist($vendorDocAttachments);
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

