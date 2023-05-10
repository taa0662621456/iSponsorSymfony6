<?php

namespace App\Form\Product\ProductBundle;

use App\Form\Product\AttributeType\Type\AttributeChoiceType;

final class ProductAttributeChoiceType extends AttributeChoiceType
{
    public function getBlockPrefix(): string
    {
        return 'product_attribute_choice';
    }
}
