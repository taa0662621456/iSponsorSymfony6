<?php


namespace App\ProductBundle\Form\Type;



final class ProductTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.product.name',
            ])
            ->add('slug', TextType::class, [
                'label' => 'form.product.slug',
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'form.product.description',
            ])
            ->add('metaKeywords', TextType::class, [
                'required' => false,
                'label' => 'form.product.meta_keywords',
            ])
            ->add('metaDescription', TextType::class, [
                'required' => false,
                'label' => 'form.product.meta_description',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product_translation';
    }
}
