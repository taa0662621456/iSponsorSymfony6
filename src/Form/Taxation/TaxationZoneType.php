<?php

namespace App\Form\Taxation;

use App\EventSubscriber\AddCodeFormSubscriber;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class TaxationZoneType extends AbstractType
{
    protected string $dataClass;

    /** @var string[] */
    protected array $validationGroups = [];

    /**
     * @param string[] $validationGroups
     * @param string[] $scopeChoices
     */
    public function __construct(array $validationGroups = [],
                                string $dataClass = 'data_class',
                                private readonly array $scopeChoices = [])
    {
        $this->dataClass = $dataClass;
        $this->validationGroups = $validationGroups;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->add('name', TextType::class, [
                'label' => 'form.zone.name',
            ])
            ->add('type', TaxationZoneTypeSelectorType::class, [
                'disabled' => true,
            ])
        ;

        if (!empty($this->scopeChoices)) {
            $builder
                ->add('scope', ChoiceType::class, [
                    'choices' => array_flip($this->scopeChoices),
                    'label' => 'form.zone.scope',
                    'placeholder' => 'form.zone.select_scope',
                    'required' => false,
                ])
            ;
        }

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
            /** @var ZoneFactoryInterface $zone */
            $zone = $event->getData();

            $entryOptions = [
                'entry_type' => $this->getZoneMemberEntryType($zone->getType()),
                'entry_options' => $this->getZoneMemberEntryOptions($zone->getType()),
            ];

//            if (ZoneInterface::TYPE_ZONE === $zone->getType()) {
//                $entryOptions['entry_options']['choice_filter'] = static fn (?ZoneInterface $subZone): bool => null !== $subZone && $zone->getId() !== $subZone->getId();
//            }

            $event->getForm()->add('members', CollectionType::class, [
                'entry_type' => TaxationZoneMemberType::class,
                'entry_options' => $entryOptions,
                'button_add_label' => 'form.zone.add_member',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'delete_empty' => true,
            ]);
        });

        $builder->addEventSubscriber(new BuildZoneFormSubscriber());
    }

    public function getBlockPrefix(): string
    {
        return 'zone';
    }

    private function getZoneMemberEntryType(string $zoneMemberType): string
    {
        $zoneMemberEntryTypes = [
//            ZoneInterface::TYPE_COUNTRY => AddressCountryCodeCollectionType::class,
//            ZoneInterface::TYPE_PROVINCE => AddressProvinceCodeSelectorType::class,
//            ZoneInterface::TYPE_ZONE => TaxationZoneCodeSelectorType::class,
        ];

        return $zoneMemberEntryTypes[$zoneMemberType];
    }

    private function getZoneMemberEntryOptions(string $zoneMemberType): array
    {
        $zoneMemberEntryOptions = [
//            ZoneInterface::TYPE_COUNTRY => [
//                'label' => 'form.zone.types.country',
//                'enabled' => false,
//                'attr' => ['class' => 'country_search_dropdown ui fluid search selection dropdown'],
//            ],
//            ZoneInterface::TYPE_PROVINCE => ['label' => 'form.zone.types.province'],
//            ZoneInterface::TYPE_ZONE => ['label' => 'form.zone.types.zone'],
        ];

        return $zoneMemberEntryOptions[$zoneMemberType];
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => $this->dataClass,
            'validation_groups' => $this->validationGroups,
        ]);
    }
}
