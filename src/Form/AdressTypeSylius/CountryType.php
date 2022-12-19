<?php


namespace App\AddressingBundle\Form\Type;



final class CountryType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber(\Symfony\Component\Form\Extension\Core\Type\CountryType::class))
            ->add('provinces', CollectionType::class, [
                'entry_type' => ProvinceType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'button_add_label' => 'form.country.add_province',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'country';
    }
}
