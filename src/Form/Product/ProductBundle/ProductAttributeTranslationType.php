<?php

namespace App\Form\Product\ProductBundle;

use App\Form\Product\AttributeType\Type\AttributeTranslationType;

final class ProductAttributeTranslationType extends AttributeTranslationType
{
    public function getBlockPrefix(): string
    {
        return 'product_attribute_translation';
    }
}