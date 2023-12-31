<?php

namespace App\EventSubscriber\Product;

use Webmozart\Assert\Assert;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\EntityInterface\Product\ProductInterface;
use App\Form\Product\ProductBundle\ProductOptionChoiceType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\ServiceInterface\Product\ProductVariantResolverServiceInterface;

final class ProductOptionFieldSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly ProductVariantResolverServiceInterface $productVariantResolver)
    {
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

        $form = $event->getForm();

        /** Options should be disabled for configurable product if it has at least one defined variant */
        $disableOptions = (null !== $this->productVariantResolver->getVariant($product)) && $product->hasVariants();

        $form->add('options', ProductOptionChoiceType::class, [
            'required' => false,
            'disabled' => $disableOptions,
            'multiple' => true,
            'label' => 'form.product.options',
        ]);
    }
}
