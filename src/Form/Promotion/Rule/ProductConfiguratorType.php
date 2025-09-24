<?php

namespace App\Form\Promotion\Rule;

use App\Dto\Product\ProductDTO;
use Symfony\Component\Form\AbstractType;
use App\Service\ResourceIdentifierTransformer;
use Symfony\Component\Form\ReversedTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\RepositoryInterface\Product\ProductRepositoryInterface;
use App\Form\Product\ProductBundle\ProductAutocompleteChoiceType;

final class ProductConfiguratorType extends AbstractType
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product_code', ProductAutocompleteChoiceType::class, [
                'label' => 'form.promotion_action.add_product_configuration.product',
                'constraints' => [
                    new NotBlank(['groups' => ['isponsor']]),
                    new Type(['type' => 'string', 'groups' => ['isponsor']]),
                    'data_class' => ProductDTO::class,
                ],
            ]);

        try {
            $builder->get('product_code')->addModelTransformer(
                new ReversedTransformer(new ResourceIdentifierTransformer($this->productRepository, 'code')),
            );
        } catch (\ReflectionException $e) {
        }
    }

    public function getBlockPrefix(): string
    {
        return 'promotion_rule_contains_product_configuration';
    }
}