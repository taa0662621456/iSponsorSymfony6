<?php


namespace App\CoreBundle\Form\Type\Taxon;




use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ProductTaxonAutocompleteChoiceType extends AbstractType
{
    public function __construct(private FactoryInterface $productTaxonFactory, private RepositoryInterface $productTaxonRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['multiple']) {
            $builder->addModelTransformer(
                new RecursiveTransformer(
                    new ProductTaxonToTaxonTransformer(
                        $this->productTaxonFactory,
                        $this->productTaxonRepository,
                        $options['product'],
                    ),
                ),
            );
        }

        if (!$options['multiple']) {
            $builder->addModelTransformer(
                new ProductTaxonToTaxonTransformer(
                    $this->productTaxonFactory,
                    $this->productTaxonRepository,
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
            ->setAllowedTypes('product', ProductInterface::class)
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
