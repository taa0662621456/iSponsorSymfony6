<?php

namespace App\Form\Product\ProductBundle;

use App\Form\Product\AttributeType\Type\AttributeValueType;

final class ProductAttributeValueType extends AttributeValueType
{
    public function getBlockPrefix(): string
    {
        return 'product_attribute_value';
    }
}
