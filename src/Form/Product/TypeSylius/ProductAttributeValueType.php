<?php


namespace App\ProductBundle\Form\Type;

use Sylius\Bundle\AttributeBundle\Form\Type\AttributeValueType;

final class ProductAttributeValueType extends AttributeValueType
{
    public function getBlockPrefix(): string
    {
        return 'product_attribute_value';
    }
}
