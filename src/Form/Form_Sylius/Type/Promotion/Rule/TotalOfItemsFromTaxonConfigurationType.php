<?php


namespace App\CoreBundle\Form\Type\Promotion\Rule;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ReversedTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class TotalOfItemsFromTaxonConfigurationType extends AbstractType
{
    public function __construct(private RepositoryInterface $taxonRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('taxon', TaxonAutocompleteChoiceType::class, [
                'label' => 'form.promotion_rule.total_of_items_from_taxon.taxon',
            ])
            ->add('amount', MoneyType::class, [
                'label' => 'form.promotion_rule.total_of_items_from_taxon.amount',
                'currency' => $options['currency'],
            ])
        ;

        $builder->get('taxon')->addModelTransformer(
            new ReversedTransformer(new ResourceToIdentifierTransformer($this->taxonRepository, 'code')),
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setRequired('currency')
            ->setAllowedTypes('currency', 'string')
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'promotion_rule_total_of_items_from_taxon_configuration';
    }
}
