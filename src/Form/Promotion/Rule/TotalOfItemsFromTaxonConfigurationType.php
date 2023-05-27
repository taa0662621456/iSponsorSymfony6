<?php

namespace App\Form\Promotion\Rule;

use App\RepositoryInterface\Taxation\TaxationRepositoryInterface;
use App\Form\Product\ProductTaxationAutocompleteSelectorType;
use App\Service\ResourceIdentifierTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ReversedTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class TotalOfItemsFromTaxonConfigurationType extends AbstractType
{
    public function __construct(private readonly TaxationRepositoryInterface $taxationRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('taxon', ProductTaxationAutocompleteSelectorType::class, [
                'label' => 'form.promotion_rule.total_of_items_from_taxon.taxon',
            ])
            ->add('amount', MoneyType::class, [
                'label' => 'form.promotion_rule.total_of_items_from_taxon.amount',
                'currency' => $options['currency'],
            ])
        ;

        $builder->get('taxon')->addModelTransformer(
            new ReversedTransformer(new ResourceIdentifierTransformer($this->taxationRepository, 'code')),
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
