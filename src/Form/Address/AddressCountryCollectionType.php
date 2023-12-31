<?php

namespace App\Form\Address;

use App\Dto\Address\AddressCountryDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\RepositoryInterface\Country\AddressCountryRepositoryInterface;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;

final class AddressCountryCollectionType extends AbstractType
{
    public function __construct(private readonly AddressCountryRepositoryInterface $addressCountryRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['multiple']) {
            $builder->addModelTransformer(new CollectionToArrayTransformer());
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'choice_filter' => null,
                'choices' => function (Options $options): iterable {
                    if (true === $options['enabled']) {
                        return $this->addressCountryRepository->findBy(['enabled' => $options['enabled']]);
                    }

                    return $this->addressCountryRepository->findAll();
                },
                'choice_value' => 'code',
                'choice_label' => 'name',
                'choice_translation_domain' => false,
                'enabled' => true,
                'label' => 'form.address.country',
                'placeholder' => 'form.country.select',
                'data_class' => AddressCountryDTO::class,
            ])
            ->setAllowedTypes('choice_filter', ['null', 'callable'])
            ->setNormalizer('choices', static function (Options $options, array $countries): array {
                if ($options['choice_filter']) {
                    $countries = array_filter($countries, $options['choice_filter']);
                }

                usort($countries, static fn (AddressCountryInterface $firstCountry, AddressCountryInterface $secondCountry): int => $firstCountry->getName() <=> $secondCountry->getName());

                return $countries;
            });
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'country_choice';
    }
}
