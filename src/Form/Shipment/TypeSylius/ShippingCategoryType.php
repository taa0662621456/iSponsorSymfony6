<?php


namespace App\Form;



final class ShippingCategoryType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->add('name', TextType::class, [
                'label' => 'form.shipping_category.name',
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'form.shipping_category.description',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'shipping_category';
    }
}