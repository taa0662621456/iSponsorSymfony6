<?php


namespace App\CoreBundle\Form\Extension;



use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Intl\Countries;

final class CountryTypeExtension extends AbstractTypeExtension
{
    public function __construct(private RepositoryInterface $countryRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
            $options = [
                'label' => 'form.country.name',
                'choice_loader' => null,
            ];

            $country = $event->getData();
            if ($country instanceof CountryInterface && null !== $country->getCode()) {
                $options['disabled'] = true;
                $options['choices'] = [$this->getCountryName($country->getCode()) => $country->getCode()];
            } else {
                $options['choices'] = array_flip($this->getAvailableCountries());
            }

            $form = $event->getForm();
            $form->add('code', \Symfony\Component\Form\Extension\Core\Type\CountryType::class, $options);
        });

        $builder
            ->add('provinces', CollectionType::class, [
                'entry_type' => ProvinceType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'button_add_label' => 'form.country.add_province',
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'form.country.enabled',
            ])
        ;
    }

    public function getExtendedType(): string
    {
        return CountryType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [CountryType::class];
    }

    private function getCountryName(string $code): string
    {
        return Countries::getName($code);
    }

    /**
     * @return array|CountryInterface[]
     */
    private function getAvailableCountries(): array
    {
        $availableCountries = Countries::getNames();

        /** @var CountryInterface[] $definedCountries */
        $definedCountries = $this->countryRepository->findAll();

        foreach ($definedCountries as $country) {
            unset($availableCountries[$country->getCode()]);
        }

        return $availableCountries;
    }
}
