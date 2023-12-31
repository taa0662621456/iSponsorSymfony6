<?php

namespace Functional;

use Fidry\AliceDataFixtures\LoaderInterface;
use Fidry\AliceDataFixtures\Persistence\PurgeMode;

final class CatalogPromotionAnnouncerTest extends AbstractWebTestCase
{
    public function testItPutsCatalogPromotionIntoProcessingState(): void
    {
        $this->createClient(['test_case' => 'CatalogPromotionProcessingState']);

        $catalogPromotion = $this->getCatalogPromotion();

        /** @var CatalogPromotionAnnouncer $catalogPromotionAnnouncer */
        $catalogPromotionAnnouncer = self::$kernel->getContainer()->get('SyliusInterface');
        $catalogPromotionAnnouncer->dispatchCatalogPromotionCreatedEvent($catalogPromotion);

        $this->assertSame('processing', $catalogPromotion->getState());
    }

    public function testItActivatesCatalogPromotionWhenProcessingHasBeenFinished(): void
    {
        $this->createClient();

        $catalogPromotion = $this->getCatalogPromotion();

        /** @var CatalogPromotionAnnouncer $catalogPromotionAnnouncer */
        $catalogPromotionAnnouncer = self::$kernel->getContainer()->get('SyliusInterface');
        $catalogPromotionAnnouncer->dispatchCatalogPromotionCreatedEvent($catalogPromotion);

        $this->assertSame('active', $catalogPromotion->getState());
    }

    private function getCatalogPromotion(): CatalogPromotionInterface
    {
        /** @var LoaderInterface $fixtureLoader */
        $fixtureLoader = self::$kernel->getContainer()->get('fidry_alice_data_fixtures.loader.doctrine');
        $fixtures = $fixtureLoader->load([__DIR__.'/../DataFixtures/ORM/resources/catalog_promotions.yml'], [], [], PurgeMode::createDeleteMode());

        /** @var CatalogPromotion $catalogPromotion */
        $catalogPromotion = $fixtures['sale_1'];

        return $catalogPromotion;
    }
}
