<?php

use Api\JsonApiTestCase;
use Utils\AdminUserLoginTrait;
use Symfony\Component\HttpFoundation\Response;

final class CatalogPromotionsTest extends JsonApiTestCase
{
    use AdminUserLoginTrait;

    public function testItGetsCatalogPromotions(): void
    {
        $this->loadFixturesFromFiles(['authentication/api_administrator.yaml', 'channel.yaml', 'catalog_promotion.yaml']);
        $header = $this->getLoggedHeader();

        $this->client->request(
            'GET',
            '/api/v2/admin/catalog-promotions',
            [],
            [],
            $header
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/catalog_promotion/get_catalog_promotions_response',
            Response::HTTP_OK
        );
    }

    public function testItGetsCatalogPromotion(): void
    {
        $catalogPromotion = $this->loadFixturesAndGetCatalogPromotion();
        $header = $this->getLoggedHeader();

        $this->client->request(
            'GET',
            sprintf('/api/v2/admin/catalog-promotions/%s', $catalogPromotion->getCode()),
            [],
            [],
            $header
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/catalog_promotion/get_catalog_promotion_response',
            Response::HTTP_OK
        );
    }

    public function testItCreatesACatalogPromotion(): void
    {
        $this->loadFixturesFromFiles(['authentication/api_administrator.yaml', 'channel.yaml', 'product/product_variant.yaml']);
        $header = $this->getLoggedHeader();

        $this->client->request(
            'POST',
            '/api/v2/admin/catalog-promotions',
            [],
            [],
            $header,
            json_encode([
                'name' => 'T-Shirts discount',
                'code' => 'tshirts_discount',
                'startDate' => '2022-01-01',
                'endDate' => '2022-01-02',
                'channels' => [
                    '/api/v2/admin/channels/WEB',
                ],
                'actions' => [
                    [
                        'type' => PercentageDiscountPriceCalculator::TYPE,
                        'configuration' => [
                            'amount' => 0.5,
                        ],
                    ],
                ],
                'scopes' => [
                    [
                        'type' => InForVariantsScopeVariantChecker::TYPE,
                        'configuration' => [
                            'variants' => [
                                'MUG',
                            ],
                        ],
                    ],
                ],
                'translations' => ['en_US' => [
                    'locale' => 'en_US',
                    'label' => 'T-Shirts discount',
                    'description' => '50% discount on every T-Shirt',
                ]],
                'enabled' => true,
                'exclusive' => false,
                'priority' => 100,
            ], \JSON_THROW_ON_ERROR)
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/catalog_promotion/post_catalog_promotion_response',
            Response::HTTP_CREATED
        );
    }

    public function testItDoesNotCreateACatalogPromotionWithoutRequiredData(): void
    {
        $this->loadFixturesFromFiles(['authentication/api_administrator.yaml']);
        $header = $this->getLoggedHeader();

        $this->client->request(
            'POST',
            '/api/v2/admin/catalog-promotions',
            [],
            [],
            $header,
            json_encode([], \JSON_THROW_ON_ERROR)
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/catalog_promotion/post_catalog_promotion_without_required_data_response',
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    public function testItDoesNotCreateACatalogPromotionWithTakenCode(): void
    {
        $this->loadFixturesFromFiles(['authentication/api_administrator.yaml', 'channel.yaml', 'catalog_promotion.yaml']);
        $header = $this->getLoggedHeader();

        $this->client->request(
            'POST',
            '/api/v2/admin/catalog-promotions',
            [],
            [],
            $header,
            json_encode([
                'name' => 'Mugs discount',
                'code' => 'mugs_discount',
            ], \JSON_THROW_ON_ERROR)
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/catalog_promotion/post_catalog_promotion_with_taken_code_response',
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    public function testItDoesNotCreateACatalogPromotionWithEndDateEarlierThanStartDate(): void
    {
        $this->loadFixturesFromFiles(['authentication/api_administrator.yaml', 'channel.yaml', 'catalog_promotion.yaml']);
        $header = $this->getLoggedHeader();

        $this->client->request(
            'POST',
            '/api/v2/admin/catalog-promotions',
            [],
            [],
            $header,
            json_encode([
                'name' => 'calatog Promotion',
                'code' => 'catalog_promotion',
                'startDate' => '2021-11-04 10:42:00',
                'endDate' => '2021-10-04 10:42:00',
            ], \JSON_THROW_ON_ERROR)
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/catalog_promotion/post_catalog_promotion_with_invalid_dates_response',
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    public function testItDoesNotCreateACatalogPromotionWithInvalidScopes(): void
    {
        $this->loadFixturesFromFiles(['authentication/api_administrator.yaml', 'channel.yaml', 'product/product_variant.yaml']);
        $header = $this->getLoggedHeader();

        $this->client->request(
            'POST',
            '/api/v2/admin/catalog-promotions',
            [],
            [],
            $header,
            json_encode([
                'name' => 'T-Shirts discount',
                'code' => 'tshirts_discount',
                'channels' => [
                    '/api/v2/admin/channels/WEB',
                ],
                'actions' => [
                    [
                        'type' => PercentageDiscountPriceCalculator::TYPE,
                        'configuration' => [
                            'amount' => 0.5,
                        ],
                    ],
                ],
                'scopes' => [
                    [
                        'type' => 'invalid_type',
                        'configuration' => [
                            'variants' => ['MUG'],
                        ],
                    ], [
                        'type' => InForVariantsScopeVariantChecker::TYPE,
                        'configuration' => [],
                    ], [
                        'type' => InForVariantsScopeVariantChecker::TYPE,
                        'configuration' => [
                            'variants' => [],
                        ],
                    ], [
                        'type' => InForVariantsScopeVariantChecker::TYPE,
                        'configuration' => [
                            'variants' => ['invalid_variant'],
                        ],
                    ], [
                        'type' => InForProductScopeVariantChecker::TYPE,
                        'configuration' => [],
                    ], [
                        'type' => InForProductScopeVariantChecker::TYPE,
                        'configuration' => [
                            'products' => [],
                        ],
                    ], [
                        'type' => InForProductScopeVariantChecker::TYPE,
                        'configuration' => [
                            'products' => ['invalid_product'],
                        ],
                    ], [
                        'type' => InForTaxonsScopeVariantChecker::TYPE,
                        'configuration' => [],
                    ], [
                        'type' => InForTaxonsScopeVariantChecker::TYPE,
                        'configuration' => [
                            'taxons' => [],
                        ],
                    ], [
                        'type' => InForTaxonsScopeVariantChecker::TYPE,
                        'configuration' => [
                            'taxons' => ['invalid_taxon'],
                        ],
                    ],
                ],
                'translations' => ['en_US' => [
                    'locale' => 'en_US',
                    'label' => 'T-Shirts discount',
                    'description' => '50% discount on every T-Shirt',
                ]],
                'enabled' => true,
                'exclusive' => false,
            ], \JSON_THROW_ON_ERROR)
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/catalog_promotion/post_catalog_promotion_with_invalid_scopes_response',
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    public function testItDoesNotCreateACatalogPromotionWithInvalidActions(): void
    {
        $this->loadFixturesFromFiles(['authentication/api_administrator.yaml', 'channel.yaml', 'product/product_variant.yaml']);
        $header = $this->getLoggedHeader();

        $this->client->request(
            'POST',
            '/api/v2/admin/catalog-promotions',
            [],
            [],
            $header,
            json_encode([
                'name' => 'T-Shirts discount',
                'code' => 'tshirts_discount',
                'channels' => [
                    '/api/v2/admin/channels/WEB',
                ],
                'actions' => [
                    [
                        'type' => 'invalid_type',
                        'configuration' => [
                            'amount' => 0.5,
                        ],
                    ],
                    [
                        'type' => PercentageDiscountPriceCalculator::TYPE,
                        'configuration' => [],
                    ],
                    [
                        'type' => PercentageDiscountPriceCalculator::TYPE,
                        'configuration' => [
                            'amount' => 1.5,
                        ],
                    ],
                    [
                        'type' => PercentageDiscountPriceCalculator::TYPE,
                        'configuration' => [
                            'amount' => 'text',
                        ],
                    ],
                    [
                        'type' => FixedDiscountPriceCalculator::TYPE,
                        'configuration' => [],
                    ],
                    [
                        'type' => FixedDiscountPriceCalculator::TYPE,
                        'configuration' => [
                            'WEB' => [],
                        ],
                    ],
                    [
                        'type' => FixedDiscountPriceCalculator::TYPE,
                        'configuration' => [
                            'invalid_channel' => [
                                'amount' => 1000,
                            ],
                        ],
                    ],
                    [
                        'type' => FixedDiscountPriceCalculator::TYPE,
                        'configuration' => [
                            'WEB' => [
                                'amount' => 'text',
                            ],
                        ],
                    ],
                ],
                'scopes' => [
                    [
                        'type' => InForVariantsScopeVariantChecker::TYPE,
                        'configuration' => [
                            'variants' => [
                                'MUG',
                            ],
                        ],
                    ],
                ],
                'translations' => ['en_US' => [
                    'locale' => 'en_US',
                    'label' => 'T-Shirts discount',
                    'description' => '50% discount on every T-Shirt',
                ]],
                'enabled' => true,
                'exclusive' => false,
            ], \JSON_THROW_ON_ERROR)
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/catalog_promotion/post_catalog_promotion_with_invalid_actions_response',
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    public function testItUpdatesCatalogPromotion(): void
    {
        $catalogPromotion = $this->loadFixturesAndGetCatalogPromotion();
        $header = $this->getLoggedHeader();

        $this->client->request(
            'PUT',
            sprintf('/api/v2/admin/catalog-promotions/%s', $catalogPromotion->getCode()),
            [],
            [],
            $header,
            json_encode([
                'name' => 'T-Shirts discount',
                'code' => 'new_code',
                'actions' => [
                    [
                        'type' => PercentageDiscountPriceCalculator::TYPE,
                        'configuration' => [
                            'amount' => 0.4,
                        ],
                    ],
                ],
                'scopes' => [
                    [
                        'type' => InForVariantsScopeVariantChecker::TYPE,
                        'configuration' => [
                            'variants' => [
                                'MUG',
                            ],
                        ],
                    ],
                ],
                'channels' => [
                    '/api/v2/admin/channels/MOBILE',
                ],
                'translations' => ['en_US' => [
                    '@id' => sprintf('/api/v2/admin/catalog-promotion-translations/%s', $catalogPromotion->getTranslation('en_US')->getId()),
                    'label' => 'T-Shirts discount',
                ]],
                'enabled' => true,
                'exclusive' => false,
                'priority' => 1000,
            ], \JSON_THROW_ON_ERROR)
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'admin/catalog_promotion/put_catalog_promotion_response',
            Response::HTTP_OK
        );
    }

    private function loadFixturesAndGetCatalogPromotion(): CatalogPromotionInterface
    {
        $fixtures = $this->loadFixturesFromFiles(['authentication/api_administrator.yaml', 'channel.yaml', 'product/product_variant.yaml', 'catalog_promotion.yaml']);

        /** @var CatalogPromotionInterface $catalogPromotion */
        $catalogPromotion = $fixtures['catalog_promotion'];

        return $catalogPromotion;
    }

    private function getLoggedHeader(): array
    {
        $token = $this->logInAdminUser('api@example.com');
        $authorizationHeader = self::$kernel->getContainer()->getParameter('sylius.api.authorization_header');
        $header['HTTP_'.$authorizationHeader] = 'Bearer '.$token;

        return array_merge($header, self::CONTENT_TYPE_HEADER);
    }
}
