<?php


namespace App\CoreBundle\Form\Type\Shipping\Rule;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ChannelBasedOrderTotalLessThanOrEqualConfigurationType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entry_type' => OrderTotalLessThanOrEqualConfigurationType::class,
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
}
