<?php


namespace App\AddressingBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ZoneTypeChoiceType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'choices' => [
                    'form.zone.types.country' => ZoneInterface::TYPE_COUNTRY,
                    'form.zone.types.province' => ZoneInterface::TYPE_PROVINCE,
                    'form.zone.types.zone' => ZoneInterface::TYPE_ZONE,
                ],
                'label' => 'form.zone.type',
            ])
        ;
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
