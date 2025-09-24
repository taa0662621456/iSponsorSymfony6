<?php

namespace App\DataFixtures;

use App\Entity\Vendor\VendorMedia;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class VendorMediaFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $media = new VendorMedia();
            // Example: fake media path
            $media->setPath("vendor_media_$i.jpg");

            $manager->persist($media);
            $this->addReference('vendorMedia_' . $i, $media);
        }

        $manager->flush();
    }

    public static function getGroup(): string { return 'vendor'; }
    public static function getPriority(): int { return 10; }
}