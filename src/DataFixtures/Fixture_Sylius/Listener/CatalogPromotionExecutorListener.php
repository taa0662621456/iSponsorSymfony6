<?php


namespace App\DataFixtures\Fixture_Sylius\Listener;





use Symfony\Component\Messenger\MessageBusInterface;

final class CatalogPromotionExecutorListener extends AbstractListener implements AfterFixtureListenerInterface
{
    public function __construct(
        private AllProductVariantsCatalogPromotionsProcessorInterface $allCatalogPromotionsProcessor,
        private CatalogPromotionRepositoryInterface $catalogPromotionsRepository,
        private MessageBusInterface $messageBus,
        private iterable $defaultCriteria = [],
    ) {
    }

    public function afterFixture(FixtureEvent $fixtureEvent, array $options): void
    {
        if (!$fixtureEvent->fixture() instanceof CatalogPromotionFixture) {
            return;
        }

        $this->allCatalogPromotionsProcessor->process();

        $catalogPromotions = $this->catalogPromotionsRepository->findByCriteria($this->defaultCriteria);

        /** @var CatalogPromotionInterface $catalogPromotion */
        foreach ($catalogPromotions as $catalogPromotion) {
            // process
            $this->messageBus->dispatch(new UpdateCatalogPromotionState($catalogPromotion->getCode()));

            // activate/deactivate
            $this->messageBus->dispatch(new UpdateCatalogPromotionState($catalogPromotion->getCode()));
        }
    }

    public function getName(): string
    {
        return 'catalog_promotion_processor_executor';
    }
}
