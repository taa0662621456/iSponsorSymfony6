<?php

namespace App\Form\Taxation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

final class TaxationZoneTypeSelectorType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'choices' => function (): array {
                    $zones = $this->zoneRepository->findZonesByScope();

                    return $this->mapZonesToDTO($zones);
                },
                'label' => 'form.zone.type',
            ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'zone_type_choice';
    }
}
