<?php


namespace App\CoreBundle\Form\Type\Shipping\Calculator;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ChannelBasedPerUnitRateConfigurationType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entry_type' => PerUnitRateConfigurationType::class,
            'entry_options' => fn (ChannelInterface $channel): array => [
                'label' => $channel->getName(),
                'currency' => $channel->getBaseCurrency()->getCode(),
            ],
        ]);
    }

    public function getParent(): string
    {
        return ChannelCollectionType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'channel_based_shipping_calculator_per_unit_rate';
    }
}
