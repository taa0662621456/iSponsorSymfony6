<?php

namespace App\Form\Product\ProductBundle;

use Symfony\Component\Form\AbstractType;
use App\Dto\Product\ProductOptionValueDTO;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormBuilderInterface;
use App\EntityInterface\Product\ProductInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\EntityInterface\Product\ProductOptionInterface;
use App\Service\Product\ProductVariantToProductOptionsTransformer;

final class ProductVariantMatchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(new ProductVariantToProductOptionsTransformer($options['product']));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'entries' => function (Options $options) {
                    /** @var ProductInterface $product */
                    $product = $options['product'];

                    return $product->getOptions();
                },
                'entry_type' => ProductOptionValueChoiceType::class,
                'entry_name' => fn (ProductOptionInterface $productOption) => $productOption->getCode(),
                'entry_options' => fn (Options $options) => fn (ProductOptionInterface $productOption) => [
                    'label' => $productOption->getName(),
                    'option' => $productOption,
                    'only_available_values' => true,
                    'product' => $options['product'],
                ],
                'data_class' => ProductOptionValueDTO::class,
            ])

            ->setRequired('product')
            ->setAllowedTypes('product', ProductInterface::class);
    }

    public function getParent(): string
    {
        return FixedCollectionType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'product_variant_match';
    }
}
