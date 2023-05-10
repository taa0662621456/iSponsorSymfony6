<?php

namespace App\Form\Product;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductFilterType extends AbstractType
{
//    public function __construct(private readonly DataTransformerInterface $productsToCodesTransformer)
//    {
//    }
//
//    public function buildForm(FormBuilderInterface $builder, array $options): void
//    {
//        $builder
//            ->add('products', ProductAutocompleteChoiceType::class, [
//                'label' => 'form.promotion_filter.products',
//                'multiple' => true,
//            ])
//        ;
//
//        $builder->get('products')->addModelTransformer($this->productsToCodesTransformer);
//    }
//
//    public function getBlockPrefix(): string
//    {
//        return 'promotion_action_filter_product_configuration';
//    }
}
