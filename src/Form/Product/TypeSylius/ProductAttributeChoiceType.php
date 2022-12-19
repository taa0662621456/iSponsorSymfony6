<?php


namespace App\ProductBundle\Form\Type;

use Sylius\Bundle\AttributeBundle\Form\Type\AttributeChoiceType;

final class ProductAttributeChoiceType extends AttributeChoiceType
{
    public function getBlockPrefix(): string
    {
        return 'product_attribute_choice';
    }
}
