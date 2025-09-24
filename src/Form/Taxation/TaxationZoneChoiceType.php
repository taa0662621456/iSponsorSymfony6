<?php

namespace App\Form\Taxation;

use App\Dto\Zone\ZoneDTO;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TaxationZoneChoiceType extends ChoiceType
{
    public function __construct(OptionsResolver $resolver)
    {
        $options = [
            'choice_value' => 'code',
            'choice_label' => 'name',
            'choice_translation_domain' => false,
            'label' => 'form.address.zone',
            'placeholder' => 'form.zone.select',
            // 'choices' => $zoneRepository->getZonesByScopeTypes($scopeTypes),
            'data_class' => ZoneDTO::class,
        ];

        parent::__construct($options);

        // Additional configuration logic specific to TaxationZoneChoiceType
    }
}