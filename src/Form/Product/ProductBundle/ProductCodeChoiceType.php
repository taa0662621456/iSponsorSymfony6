<?php

namespace App\Form\Product\ProductBundle;

use App\RepositoryInterface\Product\ProductRepositoryInterface;
use App\Service\ResourceIdentifierTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ReversedTransformer;

final class ProductCodeChoiceType extends AbstractType
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(
            new ReversedTransformer(new ResourceIdentifierTransformer($this->productRepository, 'code')),
        );
    }

    public function getParent(): string
    {
        return ProductChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'product_code_choice';
    }
}
