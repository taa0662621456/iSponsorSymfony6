<?php

namespace App\EventSubscriber\Product;

use Webmozart\Assert\Assert;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Interface\Product\ProductInterface;
use Symfony\Component\Validator\Constraints\Valid;
use App\Form\Product\ProductBundle\ProductVariantType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class SimpleProductSubscriber implements EventSubscriberInterface
{
    #[ArrayShape([FormEvents::PRE_SET_DATA => 'string', FormEvents::PRE_SUBMIT => 'string'])]
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit',
        ];
    }

    public function preSetData(FormEvent $event): void
    {
        $product = $event->getData();

        /* @var ProductInterface $product */
        Assert::isInstanceOf($product, ProductInterface::class);

        if ($product->isSimple()) {
            $form = $event->getForm();

            $form->add('variant', ProductVariantType::class, [
                'property_path' => 'variants[0]',
                'constraints' => [
                    new Valid(),
                ],
            ]);
            $form->remove('options');
        }
    }

    public function preSubmit(FormEvent $event): void
    {
        $data = $event->getData();

        if (!empty($data) && \array_key_exists('variant', $data) && \array_key_exists('code', $data)) {
            $data['variant']['code'] = $data['code'];
        }
        if (!empty($data) && \array_key_exists('variant', $data) && \array_key_exists('enabled', $data)) {
            $data['variant']['enabled'] = $data['enabled'];
        }

        $event->setData($data);
    }
}
