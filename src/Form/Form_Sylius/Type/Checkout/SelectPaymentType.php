<?php


namespace App\CoreBundle\Form\Type\Checkout;



final class SelectPaymentType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('payments', ChangePaymentMethodType::class, [
            'entry_type' => PaymentType::class,
            'label' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'checkout_select_payment';
    }
}
