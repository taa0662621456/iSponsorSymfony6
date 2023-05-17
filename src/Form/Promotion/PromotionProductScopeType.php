<?php


namespace App\Form\Promotion;


use Symfony\Component\Form\AbstractType;

final class PromotionProductScopeType extends AbstractType
{
//    public function __construct(private readonly DataTransformerInterface $productsToCodesTransformer)
//    {
//    }
//
//    public function buildForm(FormBuilderInterface $builder, array $options): void
//    {
//        $builder->add('products', ProductAutocompleteChoiceType::class, [
//            'label' => 'ui.products',
//            'multiple' => true,
//            'required' => false,
//            'choice_name' => 'name',
//            'choice_value' => 'code',
//            'resource' => 'product',
//            'constraints' => [
//                new NotBlank(['groups' => 'isponsor', 'message' => 'catalog_promotion_scope.for_products.not_empty']),
//            ],
//        ]);
//
//        $builder->get('products')->addModelTransformer($this->productsToCodesTransformer);
//    }
//
//    public function getBlockPrefix(): string
//    {
//        return 'catalog_promotion_scope_product_configuration';
//    }
}
