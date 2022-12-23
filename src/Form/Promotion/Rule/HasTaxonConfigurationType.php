<?php


namespace App\CoreBundle\Form\Type\Promotion\Rule;


use Symfony\Component\Form\FormBuilderInterface;

final class HasTaxonConfigurationType extends AbstractType
{
    public function __construct(private DataTransformerInterface $taxonsToCodesTransformer)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('taxons', TaxonAutocompleteChoiceType::class, [
                'label' => 'form.promotion_rule.has_taxon.taxons',
                'multiple' => true,
            ])
        ;

        $builder->get('taxons')->addModelTransformer($this->taxonsToCodesTransformer);
    }

    public function getBlockPrefix(): string
    {
        return 'promotion_rule_has_taxon_configuration';
    }
}
