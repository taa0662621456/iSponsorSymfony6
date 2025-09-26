<?php

namespace App\DataFixtures;

use App\Entity\Vendor\VendorDocument;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class VendorDocumentFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $doc = new VendorDocument();
            // Example: add sample file name
            $doc->setFilename("document_$i.pdf");
            $manager->persist($doc);
            $this->addReference('vendorDocument_' . $i, $doc);
        }

        $manager->flush();
    }

    public static function getGroup(): string
    {
        return 'vendor';
    }

    public static function getPriority(): int
    {
        // After Media, before Vendor
        return 20;
    }
}
