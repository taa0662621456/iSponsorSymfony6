<?php

namespace App\Form\Product\ProductBundle;

use Symfony\Component\Form\AbstractType;
use App\EventSubscriber\AddCodeFormSubscriber;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

final class ProductOptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('position', IntegerType::class, [
                'required' => false,
                'label' => 'form.option.position',
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => ProductOptionTranslationType::class,
                'label' => 'form.option.name',
            ])
            ->add('values', CollectionType::class, [
                'entry_type' => ProductOptionValueType::class,
                'allow_add' => true,
                'by_reference' => false,
                'label' => false,
                'button_add_label' => 'form.option_value.add_value',
            ])
            ->addEventSubscriber(new AddCodeFormSubscriber());
    }

    public function getBlockPrefix(): string
    {
        return 'product_option';
    }
}
