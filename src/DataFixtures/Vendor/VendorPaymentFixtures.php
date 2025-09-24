<?php

namespace App\DataFixtures\Vendor;

use App\Entity\Vendor\VendorPayment;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class VendorPaymentFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $pay = new VendorPayment();
            $pay->setAccountNumber('ACC-' . $i);

            $manager->persist($pay);
            $this->addReference('vendorPayment_' . $i, $pay);
        }
        $manager->flush();
    }

    public static function getGroup(): string { return 'vendor'; }
    public static function getPriority(): int { return 30; }
}
