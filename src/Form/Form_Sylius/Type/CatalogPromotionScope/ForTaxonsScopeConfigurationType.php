<?php


namespace App\CoreBundle\Form\Type\CatalogPromotionScope;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

final class ForTaxonsScopeConfigurationType extends AbstractType
{
    public function __construct(private DataTransformerInterface $taxonsToCodesTransformer)
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
