<?php

namespace App\Form\Shipment\TypeSylius;

use Symfony\Component\Form\FormBuilderInterface;

final class ShippingMethodRuleType extends AbstractConfigurableShippingMethodElementType
{
    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('type', ShippingMethodRuleChoiceType::class, [
                'label' => 'form.shipping_method_rule.type',
                'attr' => [
                    'data-form-collection' => 'update',
                ],
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'shipping_method_rule';
    }
}
