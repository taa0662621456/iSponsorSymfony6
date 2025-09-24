<?php

namespace App\Form\Taxation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

final class TaxationScopeType extends AbstractType
{
    public function __construct(private readonly DataTransformerInterface $taxonsToCodesTransformer)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('taxons', TaxonAutocompleteChoiceType::class, [
            'label' => 'ui.taxons',
            'multiple' => true,
            'required' => false,
            'choice_value' => 'code',
            'resource' => 'taxon',
            'constraints' => [
                new NotBlank(['groups' => 'isponsor', 'message' => 'catalog_promotion_scope.for_taxons.not_empty']),
            ],
        ]);

        $builder->get('taxons')->addModelTransformer($this->taxonsToCodesTransformer);
    }

    public function getBlockPrefix(): string
    {
        return 'catalog_promotion_scope_taxon_configuration';
    }
}