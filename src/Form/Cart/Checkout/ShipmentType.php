<?php

namespace App\Form\Cart\Checkout;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ShipmentType extends AbstractType
{
    public function __construct(private readonly string $dataClass = 'data_class')
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $form = $event->getForm();
                $shipment = $event->getData();

                $form->add('method', ShippingMethodChoiceType::class, [
                    'required' => true,
                    'label' => 'form.checkout.shipping_method',
                    'subject' => $shipment,
                    'expanded' => true,
                ]);
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'data_class' => $this->dataClass,
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'checkout_shipment';
    }
}
