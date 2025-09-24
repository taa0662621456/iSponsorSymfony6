<?php


namespace App\Extension;


use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddressTypeExtension extends AbstractTypeExtension
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('channel', null)
            ->setAllowedTypes('channel', ['null', ChannelInterface::class])
        ;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var ChannelInterface|null $channel */
        $channel = $options['channel'];

        if ($channel === null || $channel->getCountries()->count() === 0) {
            return;
        }

        $oldCountryCodeField = $builder->get('countryCode');

        $countryCodeField = $builder->create(
            $oldCountryCodeField->getName(),
            $oldCountryCodeField->getType()->getInnerType()::class,
            array_replace($oldCountryCodeField->getOptions(), ['choices' => $channel->getCountries()->toArray()]),
        );

        $builder->add($countryCodeField);
    }

    public static function getExtendedTypes(): array
    {
        return [AddressType::class];
    }
}