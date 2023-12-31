<?php

namespace App\Tests\Api\Shop;

use App\Tests\Api\tests\Api\JsonApiTestCase;
use App\Tests\Api\Utils\AdminUserLoginTrait;
use Symfony\Component\HttpFoundation\Response;

final class CatalogPromotionsTest extends JsonApiTestCase
{
    use AdminUserLoginTrait;

    public function testItGetsCatalogPromotion(): void
    {
        $catalogPromotion = $this->loadFixturesAndGetCatalogPromotion();
        $this->client->request(
            'GET',
            sprintf('/api/v2/shop/catalog-promotions/%s', $catalogPromotion->getCode()),
            [],
            [],
            self::CONTENT_TYPE_HEADER
        );
        $this->assertResponse(
            $this->client->getResponse(),
            'shop/catalog_promotion/get_catalog_promotion_response',
            Response::HTTP_OK
        );
    }

    private function loadFixturesAndGetCatalogPromotion(): CatalogPromotionInterface
    {
        $fixtures = $this->loadFixturesFromFiles(['channel.yaml', 'catalog_promotion.yaml']);

        /** @var CatalogPromotionInterface $catalogPromotion */
        $catalogPromotion = $fixtures['catalog_promotion'];

        return $catalogPromotion;
    }
}
