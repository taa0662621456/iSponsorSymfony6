<?php

namespace App\Form\Product\ProductBundle;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ProductOptionTranslationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.option.name',
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'product_option_translation';
    }
}
