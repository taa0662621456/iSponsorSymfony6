<?php

namespace App\Form\Product;

use App\Form\ResourceAutocompleteChoiceType;
use App\Interface\Product\ProductPropertyInterface;
use App\Interface\Taxation\TaxationRepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ProductTaxationAutocompleteSelectorType extends AbstractType
{
    public function __construct(
                                private readonly TaxationRepositoryInterface $taxationRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['multiple']) {
            $builder->addModelTransformer(
                new RecursiveTransformer(
                    new ProductTaxToTaxTransformer(
                        $this->productTaxonFactory,
                        $this->taxationRepository,
                        $options['product'],
                    ),
                ),
            );
        }

        if (!$options['multiple']) {
            $builder->addModelTransformer(
                new ProductTaxToTaxTransformer(
                    $this->productTaxonFactory,
                    $this->taxationRepository,
                    $options['product'],
                ),
            );
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'resource' => 'taxon',
            'choice_name' => 'name',
            'choice_value' => 'code',
        ]);

        $resolver
            ->setRequired('product')
            ->setAllowedTypes('product', ProductPropertyInterface::class)
        ;
    }

    public function getParent(): string
    {
        return ResourceAutocompleteChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'product_taxon_autocomplete_choice';
    }
}
