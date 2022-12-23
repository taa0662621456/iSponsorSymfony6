<?php


namespace App\CoreBundle\Form\Extension;


use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class ProductVariantGenerationTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
            $productVariant = $event->getData();

            $event->getForm()->add('channelPricings', ChannelCollectionType::class, [
                'entry_type' => ChannelPricingType::class,
                'entry_options' => fn (ChannelInterface $channel) => [
                    'channel' => $channel,
                    'product_variant' => $productVariant,
                ],
                'label' => 'form.variant.price',
            ]);
        });
    }

    public function getExtendedType(): string
    {
        return ProductVariantGenerationType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductVariantGenerationType::class];
    }
}
