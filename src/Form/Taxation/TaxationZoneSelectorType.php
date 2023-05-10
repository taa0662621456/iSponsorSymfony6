<?php

namespace App\Form\Taxation;

use App\Interface\Zone\ZoneRepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class TaxationZoneSelectorType extends AbstractType
{
    public function __construct(private readonly ZoneRepositoryInterface $zoneRepository, private readonly array $scopeTypes = [])
    {
        if (0 === count($scopeTypes)) {
            @trigger_error('Not passing scopeTypes thru constructor is deprecated in Sylius 1.5 and it will be removed in Sylius 2.0');
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => function (Options $options): iterable {
                $zoneCriteria = [];
//                if (AddressingScope::ALL !== $options['zone_scope']) {
//                    $zoneCriteria['scope'] = [$options['zone_scope'], AddressingScope::ALL];
//                }

                return $this->zoneRepository->findBy($zoneCriteria);
            },
            'choice_value' => 'code',
            'choice_label' => 'name',
            'choice_translation_domain' => false,
            'label' => 'form.address.zone',
            'placeholder' => 'form.zone.select',
//            'zone_scope' => AddressingScope::ALL,
        ]);

        $resolver->setAllowedValues('zone_scope', array_keys($this->scopeTypes));
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'zone_choice';
    }
}
