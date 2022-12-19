<?php


namespace App\CoreBundle\Form\Type\Promotion\Action;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ChannelBasedUnitFixedDiscountConfigurationType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entry_type' => UnitFixedDiscountConfigurationType::class,
            'entry_options' => fn (ChannelInterface $channel) => [
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
