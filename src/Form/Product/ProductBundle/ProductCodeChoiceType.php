<?php

namespace App\Form\Product\ProductBundle;

use Symfony\Component\Form\AbstractType;
use App\Service\ResourceIdentifierTransformer;
use Symfony\Component\Form\ReversedTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use App\RepositoryInterface\Product\ProductRepositoryInterface;

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
