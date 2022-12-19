<?php


namespace App\CoreBundle\Form\Type\Customer;


use Symfony\Component\OptionsResolver\OptionsResolver;

final class CustomerDefaultAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('defaultAddress', AddressChoiceType::class, [
                'customer' => $options['customer'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired('customer');
    }

    public function getBlockPrefix(): string
    {
        return 'customer_default_address';
    }
}
