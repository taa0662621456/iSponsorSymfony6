<?php

namespace App\Form\Product\ProductBundle;

use Symfony\Component\Form\AbstractType;
use App\EventSubscriber\AddCodeFormSubscriber;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductOptionValueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => ProductOptionValueTranslationType::class,
                'label' => 'form.option.name',
            ])
            ->addEventSubscriber(new AddCodeFormSubscriber());
    }

    public function getBlockPrefix(): string
    {
        return 'product_option_value';
    }
}
