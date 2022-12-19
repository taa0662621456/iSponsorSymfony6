<?php


namespace App\ProductBundle\Form\Type;

use Sylius\Bundle\AttributeBundle\Form\Type\AttributeTranslationType;

final class ProductAttributeTranslationType extends AttributeTranslationType
{
    public function getBlockPrefix(): string
    {
        return 'product_attribute_translation';
    }
}
