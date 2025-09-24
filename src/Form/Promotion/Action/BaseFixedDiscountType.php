<?php


namespace App\Form\Promotion\Action;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Notifier\Channel\ChannelInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class BaseFixedDiscountType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entry_type' => FixedDiscountConfigurationType::class,
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