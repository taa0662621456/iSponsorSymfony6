<?php

namespace App\Form\Product\ProductBundle;

use App\Dto\Product\ProductVariantDTO;
use App\EntityInterface\Product\ProductInterface;
use App\EntityInterface\Product\ProductVariantInterface;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ProductVariantChoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['multiple']) {
            $builder->addViewTransformer(new CollectionToArrayTransformer(), true);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'choices' => fn (Options $options): iterable => $options['product']->getVariants(),
                'choice_value' => 'code',
                'choice_label' => fn (ProductVariantInterface $variant): string => $variant->getName() ?? $variant->getDescriptor(),
                'choice_translation_domain' => false,
                'multiple' => false,
                'expanded' => true,
                'data_class' => ProductVariantDTO::class,
            ])
            ->setRequired([
                'product',
            ])
            ->setAllowedTypes('product', ProductInterface::class)
        ;
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'product_variant_choice';
    }
}
