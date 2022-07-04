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

class VendorFixtures extends Fixture
{

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager)
	{
        $rand = random_int(0, 999999);
        $password = $rand;
        //$password = md5($rand);

        $vendor = new Vendor();
        $vendorSecurity = new VendorSecurity();
        $vendorIban = new VendorIban();
        $vendorEnGb = new VendorEnGb();
        $vendorDocument = new VendorDocument();
        $vendorMedia = new VendorMedia();

        $vendorSecurity->setEmail('taa0' . $rand . '@gmail.com');
        $vendorSecurity->setPassword($password);

        $vendorEnGb->setVendorZip($rand);
        $vendorEnGb->setFirstTitle('VendorFT' . $rand);
        $vendorEnGb->setMiddleTitle('VendorMT' . $rand);
        $vendorEnGb->setLastTitle('VendorLT' . $rand);

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

