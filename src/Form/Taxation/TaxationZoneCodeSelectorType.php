<?php

namespace App\Form\Taxation;

use Symfony\Component\Form\AbstractType;
use App\Dto\Taxation\TaxationZoneCodeDTO;
use App\Service\ResourceIdentifierTransformer;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\ReversedTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use App\EntityInterface\Zone\ZoneRepositoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

final class TaxationZoneCodeSelectorType extends AbstractType
{
    public function __construct(private readonly ZoneRepositoryInterface $zoneRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        try {
            $builder->addModelTransformer(new ReversedTransformer(new ResourceIdentifierTransformer($this->zoneRepository, 'code')));
        } catch (\ReflectionException $e) {
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'choice_filter' => null,
                'choices' => function (Options $options): iterable {
                    $zones = $this->zoneRepository->findAll();
                    if ($options['choice_filter']) {
                        $zones = array_filter($zones, $options['choice_filter']);
                    }

                    return $zones;
                },
                'choice_value' => 'code',
                'choice_label' => 'name',
                'choice_translation_domain' => false,
                'label' => 'form.zone.types.zone',
                'placeholder' => 'form.zone.select',
                'data_class' => TaxationZoneCodeDTO::class,
            ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'zone_code_choice';
    }
}
