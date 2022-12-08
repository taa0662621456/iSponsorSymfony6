<?php


namespace App\CoreBundle\Form\Type\Promotion\Filter;


use Symfony\Component\Form\FormBuilderInterface;

final class TaxonFilterConfigurationType extends AbstractType
{
    public function __construct(private DataTransformerInterface $taxonsToCodesTransformer)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('taxons', TaxonAutocompleteChoiceType::class, [
                'label' => 'form.promotion_filter.taxons',
                'multiple' => true,
                'required' => false,
            ])
        ;

        $builder->get('taxons')->addModelTransformer($this->taxonsToCodesTransformer);
    }

    public function getBlockPrefix(): string
    {
        return 'promotion_action_filter_taxon_configuration';
    }
}
