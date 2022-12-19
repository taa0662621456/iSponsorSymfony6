<?php


namespace App\CoreBundle\Form\Type\Product;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ProductImageType extends ImageType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        if (isset($options['product']) && $options['product'] instanceof ProductInterface) {
            $builder
                ->add('productVariants', ResourceAutocompleteChoiceType::class, [
                    'label' => 'ui.product_variants',
                    'multiple' => true,
                    'required' => false,
                    'choice_name' => 'descriptor',
                    'choice_value' => 'code',
                    'resource' => 'product_variant',
                ])
            ;
        }
    }

    /**
     * @psalm-suppress MissingPropertyType
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        parent::buildView($view, $form, $options);

        $view->vars['product'] = $options['product'];
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefined('product');
        $resolver->setAllowedTypes('product', ProductInterface::class);
    }

    public function getBlockPrefix(): string
    {
        return 'product_image';
    }
}
