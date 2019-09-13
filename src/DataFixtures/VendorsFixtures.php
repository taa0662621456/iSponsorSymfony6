<?php

namespace App\DataFixtures;

use App\Entity\Order\Orders;
use App\Entity\Order\OrdersItems;
use App\Entity\Vendor\Vendors;
use App\Entity\Vendor\VendorsDocAttachments;
use App\Entity\Vendor\VendorsEnGb;
use App\Entity\Vendor\VendorsIban;
use App\Entity\Vendor\VendorsMediaAttachments;
use App\Entity\Vendor\VendorsSecurity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VendorsFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
    	$rand = rand(0,999999);
    	$password = md5($rand);

    	$vendor = new Vendors();
		$vendorSecurity = new VendorsSecurity();
    	$vendorEnGb = new VendorsEnGb();
    	$vendorIban = new VendorsIban();
		$vendorOrders = new Orders();
		$vendorDocAttachments = new VendorsDocAttachments();
		$vendorMediaAttachments = new VendorsMediaAttachments();
		$vendorOrderItems = new OrdersItems();

		$vendor->setActive(true);
		$vendorEnGb->setZip($rand);
		$vendorSecurity->setEmail('taa0' . $rand . '@gmail.com');
		$vendorSecurity->setPassword($password);
		$vendorIban->setIban('0000000000000000');
		$vendorOrders->setOrderPass($password);
		$vendorDocAttachments->setFile('cover.jpg');
		$vendorDocAttachments->setFileUrl('/');
		$vendorMediaAttachments->setFile('cover.jpg');
		$vendorMediaAttachments->setFileUrl('/');
		$vendorOrderItems->setItemName('taa0' . $rand . '@gmail.com');

		$manager->persist($vendor);
		$manager->persist($vendorSecurity);
		$manager->persist($vendorEnGb);
		$manager->persist($vendorOrders);
		$manager->persist($vendorDocAttachments);
		$manager->persist($vendorMediaAttachments);
		$manager->persist($vendorOrderItems);
        $manager->flush();
    }
}
