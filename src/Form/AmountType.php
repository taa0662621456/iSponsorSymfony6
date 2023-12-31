<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Notifier\Channel\ChannelInterface;
use Symfony\Component\Validator\Constraints\GreaterThan;

final class AmountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', MoneyType::class, [
                'label' => false,
                'currency' => $options['channel']->getBaseCurrency()->getCode(),
                'constraints' => [
                    new NotBlank(['groups' => ['isponsor']]),
                    new Type(['type' => 'integer', 'groups' => ['isponsor']]),
                    new GreaterThan(['value' => 0, 'groups' => ['isponsor']]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setRequired('channel')
            ->setAllowedTypes('channel', [ChannelInterface::class])

            ->setDefaults([
                'label' => static fn (Options $options): string => $options['channel']->getName(),
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'shipping_total';
    }
}
