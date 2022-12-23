<?php

namespace App\Form\Promotion;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

final class PromotionProductVariantsScopeType extends AbstractType
{
    public function __construct(private readonly DataTransformerInterface $productVariantsToCodesTransformer)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('variants', ResourceAutocompleteChoiceType::class, [
            'label' => 'ui.variants',
            'multiple' => true,
            'required' => false,
            'choice_name' => 'descriptor',
            'choice_value' => 'code',
            'resource' => 'product_variant',
            'constraints' => [
                new NotBlank(['groups' => 'isponsor', 'message' => 'catalog_promotion_scope.for_variants.not_empty']),
            ],
        ]);

        $builder->get('variants')->addModelTransformer($this->productVariantsToCodesTransformer);
    }

    public function getBlockPrefix(): string
    {
        return 'catalog_promotion_scope_variant_configuration';
    }
}
