<?php

namespace App\Form\Product\ProductBundle;

use Symfony\Component\Form\AbstractType;
use App\EventSubscriber\AddCodeFormSubscriber;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductAssociationTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => ProductAssociationTypeTranslationType::class,
                'label' => 'form.product_association_type.translations',
            ])
            ->addEventSubscriber(new AddCodeFormSubscriber());
    }

    public function getBlockPrefix(): string
    {
        return 'product_association_type';
    }
}
