<?php

namespace App\EventListener\Listener_Sylius;

use App\DataFixtures\Promotion\CatalogPromotionFixture;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Security\Http\Firewall\AbstractListener;

class CatalogPromotionExecutorListener extends AbstractListener implements AfterFixtureListenerInterface
{
    public function __construct(
        private readonly AllProductVariantsCatalogPromotionsProcessorInterface $allCatalogPromotionsProcessor,
        private readonly CatalogPromotionRepositoryInterface $catalogPromotionsRepository,
        private readonly MessageBusInterface $messageBus,
        private readonly iterable $defaultCriteria = [],
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

    public function supports(Request $request): ?bool
    {
        return true;
        // TODO: Implement supports() method.
    }

    public function authenticate(RequestEvent $event)
    {
        // TODO: Implement authenticate() method.
    }
}
