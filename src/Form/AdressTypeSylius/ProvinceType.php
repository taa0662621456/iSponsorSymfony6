<?php


namespace App\AddressingBundle\Form\Type;



final class ProvinceType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->add('name', TextType::class, [
                'label' => 'form.province.name',
            ])
            ->add('abbreviation', TextType::class, [
                'label' => 'form.province.abbreviation',
                'required' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'province';
    }
}
