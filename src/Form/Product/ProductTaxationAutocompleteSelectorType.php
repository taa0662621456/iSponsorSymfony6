<?php

namespace App\Form\Product;

use App\EntityInterface\Product\ProductPropertyInterface;
use App\Service\RecursiveTransformer;
use Symfony\Component\Form\AbstractType;
use App\Form\ResourceAutocompleteChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\RepositoryInterface\Taxation\TaxationRepositoryInterface;

/**
 * @property $productTaxonFactory
 */
final class ProductTaxationAutocompleteSelectorType extends AbstractType
{
    public function __construct(
        private readonly TaxationRepositoryInterface $taxationRepository
    ) {
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
            ->setAllowedTypes('product', ProductPropertyInterface::class);
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
