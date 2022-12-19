<?php


namespace App\Tests\Api\Shop;


use SyliusInterface
    {
        $fixtures = $this->loadFixturesFromFiles(['channel.yaml', 'catalog_promotion.yaml']);

        /** @var CatalogPromotionInterface $catalogPromotion */
        $catalogPromotion = $fixtures['catalog_promotion'];

        return $catalogPromotion;
    }
}
