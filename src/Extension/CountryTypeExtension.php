<?php


namespace App\Extension;

use App\Form\Address\AddressCountryType;
use App\Form\Address\AddressProvinceType;
use App\Interface\Address\AddressCountryInterface;
use App\Interface\Country\AddressCountryRepositoryInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Intl\Countries;

final class CountryTypeExtension extends AbstractTypeExtension
{
    public function __construct(private readonly AddressCountryRepositoryInterface $addressCountryRepository)
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
            if ($country instanceof AddressCountryInterface && null !== $country->getCode()) {
                $options['disabled'] = true;
                $options['choices'] = [$this->getCountryName($country->getCode()) => $country->getCode()];
            } else {
                $options['choices'] = array_flip($this->getAvailableCountries());
            }

            $form = $event->getForm();
            $form->add('code', CountryType::class, $options);
        });

        $builder
            ->add('provinces', CollectionType::class, [
                'entry_type' => AddressProvinceType::class,
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
        return AddressCountryType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [AddressCountryType::class];
    }

    private function getCountryName(string $code): string
    {
        return Countries::getName($code);
    }

    /**
     * @return array|AddressCountryInterface[]
     */
    private function getAvailableCountries(): array
    {
        $availableCountries = Countries::getNames();

        /** @var AddressCountryInterface[] $definedCountries */
        $definedCountries = $this->addressCountryRepository->findAll();

        foreach ($definedCountries as $country) {
            unset($availableCountries[$country->getCode()]);
        }

        return $availableCountries;
    }
}
