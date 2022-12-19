<?php


namespace App\CoreBundle\Form\Type\Promotion\Filter;


use Symfony\Component\Form\FormBuilderInterface;

final class ProductFilterConfigurationType extends AbstractType
{
    public function __construct(private DataTransformerInterface $productsToCodesTransformer)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('products', ProductAutocompleteChoiceType::class, [
                'label' => 'form.promotion_filter.products',
                'multiple' => true,
            ])
        ;

        $builder->get('products')->addModelTransformer($this->productsToCodesTransformer);
    }

    public function getBlockPrefix(): string
    {
        return 'promotion_action_filter_product_configuration';
    }
}
