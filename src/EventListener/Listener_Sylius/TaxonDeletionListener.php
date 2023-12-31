<?php

namespace App\EventListener\Listener_Sylius;

use Webmozart\Assert\Assert;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

final class TaxonDeletionListener
{
    /** @var TaxonAwareRuleUpdaterInterface[] */
    private array $ruleUpdaters;

    public function __construct(
        private SessionInterface|RequestStack $requestStackOrSession,
        private ChannelRepositoryInterface $channelRepository,
        TaxonAwareRuleUpdaterInterface ...$ruleUpdaters,
    ) {
        $this->ruleUpdaters = $ruleUpdaters;

        if ($requestStackOrSession instanceof SessionInterface) {
            trigger_deprecation('sylius/user-bundle', '1.12', sprintf('Passing an instance of %s as constructor argument for %s is deprecated as of Sylius 1.12 and will be removed in 2.0. Pass an instance of %s instead.', SessionInterface::class, self::class, RequestStack::class));
        }
    }

    public function protectFromRemovingMenuTaxon(GenericEvent $event): void
    {
        $taxon = $event->getSubject();
        Assert::isInstanceOf($taxon, TaxonInterface::class);

        $channel = $this->channelRepository->findOneBy(['menuTaxon' => $taxon]);
        if (null !== $channel) {
            /** @var FlashBagInterface $flashes */
            $flashes = FlashBagProvider::getFlashBag($this->requestStackOrSession);
            $flashes->add('error', 'sylius.taxon.menu_taxon_delete');

            $event->stopPropagation();
        }
    }

    public function removeTaxonFromPromotionRules(GenericEvent $event): void
    {
        $taxon = $event->getSubject();
        Assert::isInstanceOf($taxon, TaxonInterface::class);

        $updatedPromotionCodes = [];
        foreach ($this->ruleUpdaters as $ruleUpdater) {
            $updatedPromotionCodes = array_merge($updatedPromotionCodes, $ruleUpdater->updateAfterDeletingTaxon($taxon));
        }

        if (!empty($updatedPromotionCodes)) {
            $flashes = FlashBagProvider::getFlashBag($this->requestStackOrSession);
            $flashes->add('info', [
                'message' => 'sylius.promotion.update_rules',
                'parameters' => ['%codes%' => implode(', ', array_unique($updatedPromotionCodes))],
            ]);
        }
    }

    public function handleRemovingRootTaxonAtPositionZero(GenericEvent $event): void
    {
        /** @var TaxonInterface $taxon */
        $taxon = $event->getSubject();
        Assert::isInstanceOf($taxon, TaxonInterface::class);

        if (0 === $taxon->getPosition()) {
            $taxon->setPosition(-1);
        }
    }
}
