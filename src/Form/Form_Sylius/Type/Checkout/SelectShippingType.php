<?php


namespace App\CoreBundle\Form\Type\Checkout;



final class SelectShippingType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('shipments', CollectionType::class, [
            'entry_type' => ShipmentType::class,
            'label' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'checkout_select_shipping';
    }
}
