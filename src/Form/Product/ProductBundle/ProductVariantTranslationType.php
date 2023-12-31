<?php

namespace App\Form\Product\ProductBundle;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ProductVariantTranslationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.product_variant.name',
                'required' => false,
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'product_variant_translation';
    }
}
