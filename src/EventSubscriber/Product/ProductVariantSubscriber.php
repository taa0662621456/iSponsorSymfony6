<?php

namespace App\EventSubscriber\Product;

use App\Exception\VariantWithNoOptionsValuesException;
use App\Interface\Product\ProductInterface;
use App\Interface\Product\ProductVariantInterface;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Webmozart\Assert\Assert;

final class ProductVariantSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly ProductVariantInterface $productVariant,
        private readonly RequestStack $requestStackOrSession
    ) {
        if ($requestStackOrSession instanceof SessionInterface) {
            @trigger_error(sprintf('Passing an instance of %s as constructor argument for %s is deprecated as of Sylius 1.12 and will be removed in 2.0. Pass an instance of %s instead.', SessionInterface::class, self::class, RequestStack::class), \E_USER_DEPRECATED);
        }
    }

    #[ArrayShape([FormEvents::PRE_SET_DATA => 'string'])]
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
        ];
    }

    public function preSetData(FormEvent $event): void
    {
        $product = $event->getData();

        /* @var ProductInterface $product */
        Assert::isInstanceOf($product, ProductInterface::class);

        try {
            $this->productVariant->generate($product);
        } catch (VariantWithNoOptionsValuesException $exception) {
            $this->getFlashBag()->add('error', $exception->getMessage());
        }
    }

    private function getFlashBag(): SessionBagInterface
    {
        if ($this->requestStackOrSession instanceof RequestStack) {
            return $this->requestStackOrSession->getSession()->getBag('flashes');
        }

        return $this->requestStackOrSession->getBag('flashes');
    }
}
