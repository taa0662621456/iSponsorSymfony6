<?php

namespace App\Form\Payum;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

final class PaypalGatewayConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'form.gateway_configuration.paypal.username',
                'constraints' => [
                    new NotBlank([
                        'message' => 'gateway_config.paypal.username.not_blank',
                        'groups' => 'isponsor',
                    ]),
                ],
            ])
            ->add('password', TextType::class, [
                'label' => 'form.gateway_configuration.paypal.password',
                'constraints' => [
                    new NotBlank([
                        'message' => 'gateway_config.paypal.password.not_blank',
                        'groups' => 'isponsor',
                    ]),
                ],
            ])
            ->add('signature', TextType::class, [
                'label' => 'form.gateway_configuration.paypal.signature',
                'constraints' => [
                    new NotBlank([
                        'message' => 'gateway_config.paypal.signature.not_blank',
                        'groups' => 'isponsor',
                    ]),
                ],
            ])
            ->add('sandbox', CheckboxType::class, [
                'label' => 'form.gateway_configuration.paypal.sandbox',
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $data = $event->getData();

                $data['payum.http_client'] = '@sylius.payum.http_client';
            });
    }
}
