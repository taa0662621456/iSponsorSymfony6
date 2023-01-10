<?php

namespace App\Extension;

use App\Form\Product\ProductBundle\ProductTranslationType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductTranslationTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('shortDescription', TextareaType::class, [
                'required' => false,
                'label' => 'form.product.short_description',
            ])
        ;
    }

    public function getExtendedType(): string
    {
        return ProductTranslationType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductTranslationType::class];
    }
}
