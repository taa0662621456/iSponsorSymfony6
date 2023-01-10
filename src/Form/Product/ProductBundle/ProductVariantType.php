<?php

namespace App\Form\Product\ProductBundle;

use App\EventSubscriber\AddCodeFormSubscriber;
use App\EventSubscriber\Product\BuildProductVariantFormSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductVariantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('enabled', CheckboxType::class, [
                'required' => false,
                'label' => 'form.product.enabled',
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => ProductVariantTranslationType::class,
                'label' => 'form.product_variant.translations',
            ])
            ->addEventSubscriber(new AddCodeFormSubscriber())
        ;

        $builder->addEventSubscriber(new BuildProductVariantFormSubscriber($builder->getFormFactory()));
    }

    public function getBlockPrefix(): string
    {
        return 'product_variant';
    }
}
