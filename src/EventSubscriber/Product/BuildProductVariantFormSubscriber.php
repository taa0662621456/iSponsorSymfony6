<?php


namespace App\EventSubscriber\Product;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;

final class BuildProductVariantFormSubscriber implements EventSubscriberInterface
{
    public function __construct(private FormFactoryInterface $factory, private bool $disabled = false)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
        ];
    }

    public function preSetData(FormEvent $event): void
    {
        /** @var ProductVariantInterface|null $productVariant */
        $productVariant = $event->getData();
        $form = $event->getForm();

        if (null === $productVariant) {
            return;
        }

        $product = $productVariant->getProduct();

        if (!$product->hasOptions()) {
            return;
        }

        $form->add($this->factory->createNamed(
            'optionValues',
            ProductOptionValueCollectionType::class,
            $productVariant->getOptionValues(),
            [
                'disabled' => $this->disabled,
                'options' => $product->getOptions(),
                'auto_initialize' => false,
            ],
        ));
    }
}
