<?php

namespace App\Form\Shipment\TypeSylius;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

final class ShippingMethodRuleChoiceType extends AbstractType
{
    public function __construct(private readonly array $rules = [])
    {
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => array_flip($this->rules),
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'shipping_method_rule_choice';
    }
}
