<?php


namespace App\Form\Taxation;


use App\Interface\Zone\ZoneRepositoryInterface;
use App\Service\ResourceToIdentifierTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ReversedTransformer;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class TaxationZoneCodeSelectorType extends AbstractType
{
    public function __construct(private readonly ZoneRepositoryInterface $zoneRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(new ReversedTransformer(new ResourceToIdentifierTransformer($this->zoneRepository, 'code')));
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
            ])
        ;
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
