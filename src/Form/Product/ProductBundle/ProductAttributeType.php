<?php

namespace App\Form\Product\ProductBundle;

use Symfony\Component\Form\FormBuilderInterface;
use App\Form\Product\AttributeType\Type\AttributeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

final class ProductAttributeType extends AttributeType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('position', IntegerType::class, [
                'required' => false,
                'label' => 'form.product_attribute.position',
                'invalid_message' => 'product_attribute.invalid',
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'product_attribute';
    }
}
