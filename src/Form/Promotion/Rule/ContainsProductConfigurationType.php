<?php


namespace App\Form\Promotion\Rule;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ReversedTransformer;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

final class ContainsProductConfigurationType extends AbstractType
{
    public function __construct(private RepositoryInterface $productRepository)
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
                ],
            ])
        ;

        $builder->get('product_code')->addModelTransformer(
            new ReversedTransformer(new ResourceToIdentifierTransformer($this->productRepository, 'code')),
        );
    }

    public function getBlockPrefix(): string
    {
        return 'promotion_rule_contains_product_configuration';
    }
}
