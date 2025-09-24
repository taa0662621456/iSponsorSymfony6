<?php


namespace App\Extension;


use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class ProductVariantTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('version', HiddenType::class)
            ->add('tracked', CheckboxType::class, [
                'label' => 'form.variant.tracked',
                'help' => 'form.variant.tracked_help',
            ])
            ->add('shippingRequired', CheckboxType::class, [
                'label' => 'form.variant.shipping_required',
            ])
            ->add('onHand', IntegerType::class, [
                'label' => 'form.variant.on_hand',
            ])
            ->add('width', NumberType::class, [
                'required' => false,
                'label' => 'form.variant.width',
                'invalid_message' => 'product_variant.width.invalid',
            ])
            ->add('height', NumberType::class, [
                'required' => false,
                'label' => 'form.variant.height',
                'invalid_message' => 'product_variant.height.invalid',
            ])
            ->add('depth', NumberType::class, [
                'required' => false,
                'label' => 'form.variant.depth',
                'invalid_message' => 'product_variant.depth.invalid',
            ])
            ->add('weight', NumberType::class, [
                'required' => false,
                'label' => 'form.variant.weight',
                'invalid_message' => 'product_variant.weight.invalid',
            ])
            ->add('taxCategory', TaxCategoryChoiceType::class, [
                'required' => false,
                'placeholder' => '---',
                'label' => 'form.product_variant.tax_category',
            ])
            ->add('shippingCategory', ShippingCategoryChoiceType::class, [
                'required' => false,
                'placeholder' => 'ui.no_requirement',
                'label' => 'form.product_variant.shipping_category',
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
            $productVariant = $event->getData();

            $event->getForm()->add('channelPricings', ChannelCollectionType::class, [
                'entry_type' => ChannelPricingType::class,
                'entry_options' => fn (ChannelInterface $channel) => [
                    'channel' => $channel,
                    'product_variant' => $productVariant,
                    'required' => false,
                ],
                'label' => 'form.variant.price',
            ]);
        });
    }

    public function getExtendedType(): string
    {
        return ProductVariantType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductVariantType::class];
    }
}