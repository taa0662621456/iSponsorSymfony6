<?php

namespace App\DataFixtures;

use App\Entity\Vendor\Vendors;
use App\Entity\Vendor\VendorsDocAttachments;
use App\Entity\Vendor\VendorsEnGb;
use App\Entity\Vendor\VendorsIban;
use App\Entity\Vendor\VendorsMediaAttachments;
use App\Entity\Vendor\VendorsSecurity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;

class VendorsFixtures extends Fixture implements FixtureGroupInterface
{

    public function load(ObjectManager $manager)
    {

    	$rand = rand(0,999999);
    	$password = md5($rand);

    	$vendor = new Vendors();
		$vendorSecurity = new VendorsSecurity();
    	$vendorIban = new VendorsIban();
    	$vendorEnGb = new VendorsEnGb();
		$vendorDocAttachments = new VendorsDocAttachments();
		$vendorMediaAttachments = new VendorsMediaAttachments();


		$vendor->setVendorSlug('slug' . 1);
		$vendor->setOtep('ok');
		$vendorEnGb->setVendorZip($rand);
		$vendorSecurity->setEmail('taa0' . $rand . '@gmail.com');
		$vendorSecurity->setPassword($password);
		$vendorIban->setIban('0000000000000000');
		$vendorDocAttachments->setFile('cover.jpg');
		$vendorDocAttachments->setFileUrl('/');
		$vendorMediaAttachments->setFile('cover.jpg');
		$vendorMediaAttachments->setFileUrl('/');

		$manager->persist($vendor);
		$manager->persist($vendorSecurity);
		$manager->persist($vendorIban);
		$manager->persist($vendorEnGb);
		$manager->persist($vendorDocAttachments);
		$manager->persist($vendorMediaAttachments);
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
