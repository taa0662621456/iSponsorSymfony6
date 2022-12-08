<?php


namespace App\ProductBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ReversedTransformer;

final class ProductCodeChoiceType extends AbstractType
{
    public function __construct(private RepositoryInterface $productRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(
            new ReversedTransformer(new ResourceToIdentifierTransformer($this->productRepository, 'code')),
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
