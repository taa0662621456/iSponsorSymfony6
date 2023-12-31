<?php

namespace App\Form\Payum;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Payum\Core\Model\GatewayConfigInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class GatewayConfigurationType extends AbstractResourceType
{
    public function __construct(
        string $dataClass,
        array $validationGroups,
        private FormTypeRegistryInterface $gatewayConfigurationTypeRegistry,
    ) {
        parent::__construct($dataClass, $validationGroups);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $factoryName = $options['data']->getFactoryName();

        $builder
            ->add('factoryName', TextType::class, [
                'label' => 'form.gateway_config.type',
                'disabled' => true,
                'data' => $factoryName,
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($factoryName) {
                $gatewayConfig = $event->getData();

                if (!$gatewayConfig instanceof GatewayConfigInterface) {
                    return;
                }

                if (!$this->gatewayConfigurationTypeRegistry->has('gateway_config', $factoryName)) {
                    return;
                }

                $configType = $this->gatewayConfigurationTypeRegistry->get('gateway_config', $factoryName);
                $event->getForm()->add('config', $configType, [
                    'label' => false,
                    'auto_initialize' => false,
                ]);
            });
    }

    public function getBlockPrefix(): string
    {
        return 'payum_gateway_config';
    }
}
