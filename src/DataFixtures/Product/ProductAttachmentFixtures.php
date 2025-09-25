<?php

namespace App\DataFixtures\Product;

use App\Entity\Product\ProductAttachment;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class ProductAttachmentFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $product = $this->getReference('product_1');

        $att = new ProductAttachment();
        $att->setFilePath('images/smarttv.jpg');
        $att->setProduct($product);

        $manager->persist($att);
        $this->addReference('productAttachment_1', $att);

        $manager->flush();
    }

    public static function getGroup(): string { return 'product'; }
    public static function getPriority(): int { return 40; }
}
