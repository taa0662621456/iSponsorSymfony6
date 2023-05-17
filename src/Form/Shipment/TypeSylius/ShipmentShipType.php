<?php


namespace App\Form\Shipment\TypeSylius;



use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class ShipmentShipType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tracking', TextType::class, [
                'required' => false,
                'label' => 'form.shipment.tracking_code',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'shipment_ship';
    }
}
