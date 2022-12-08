<?php


namespace App\Form;



final class ShippingMethodTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.shipping_method.name',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'form.shipping_method.description',
                'required' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'shipping_method_translation';
    }
}
