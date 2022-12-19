<?php


namespace App\CoreBundle\Form\Type\Customer;



final class CustomerRegistrationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('firstName', TextType::class, [
                'label' => 'form.customer.first_name',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'form.customer.last_name',
            ])
            ->add('phoneNumber', TextType::class, [
                'required' => false,
                'label' => 'form.customer.phone_number',
            ])
            ->add('subscribedToNewsletter', CheckboxType::class, [
                'required' => false,
                'label' => 'form.customer.subscribed_to_newsletter',
            ])
        ;
    }

    public function getParent(): string
    {
        return CustomerSimpleRegistrationType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'customer_registration';
    }
}
