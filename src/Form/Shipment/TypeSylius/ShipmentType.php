<?php

namespace App\Form\Shipment\TypeSylius;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

final class ShipmentType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('state', ChoiceType::class, [
                'choices' => [
                    'form.shipment.states.cart' => ShipmentInterface::STATE_CART,
                    'form.shipment.states.ready' => ShipmentInterface::STATE_READY,
                    'form.shipment.states.shipped' => ShipmentInterface::STATE_SHIPPED,
                    'form.shipment.states.cancelled' => ShipmentInterface::STATE_CANCELLED,
                ],
                'label' => 'form.shipment.state',
            ])
            ->add('tracking', TextType::class, [
                'label' => 'form.shipment.tracking_code',
                'required' => false,
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'shipment';
    }
}
