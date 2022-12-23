<?php


namespace App\Form\Taxation;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormBuilderInterface;

final class TaxationFilterType extends AbstractType
{
    public function __construct(private readonly DataTransformerInterface $taxationToCodesTransformer)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('taxation', TaxonAutocompleteChoiceType::class, [
                'label' => 'form.promotion_filter.taxation',
                'multiple' => true,
                'required' => false,
            ])
        ;

        $builder->get('taxation')->addModelTransformer($this->taxationToCodesTransformer);
    }

    public function getBlockPrefix(): string
    {
        return 'promotion_action_filter_taxon_configuration';
    }
}
