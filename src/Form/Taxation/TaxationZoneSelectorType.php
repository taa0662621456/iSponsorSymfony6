<?php

namespace App\Form\Taxation;

use App\Dto\Taxation\TaxationZoneDTO;
use App\Entity\Taxation\TaxationZone;
use Symfony\Component\Form\AbstractType;
use App\Repository\Taxation\TaxationZoneRepository;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

final class TaxationZoneSelectorType extends AbstractType
{
    private TaxationZoneRepository $taxationZoneRepository;

    public function __construct(TaxationZoneRepository $taxationZoneRepository)
    {
        $this->taxationZoneRepository = $taxationZoneRepository;
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => function (): array {
                $zones = $this->taxationZoneRepository->findZoneByScope();

                return $this->mapZoneToDTO($zones);
            },
            'choice_value' => 'code',
            'choice_label' => 'name',
            'choice_translation_domain' => false,
            'label' => 'form.address.zone',
            'placeholder' => 'form.zone.select',
        ]);
    }

    private function mapZoneToDTO(array $zones): array
    {
        return array_map(function (TaxationZone $zone) {
            return new TaxationZoneDTO($zone->getCode(), $zone->getName());
        }, $zones);
    }

    public function getBlockPrefix(): string
    {
        return 'zone_choice';
    }
}
