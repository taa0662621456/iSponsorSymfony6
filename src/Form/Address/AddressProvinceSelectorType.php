<?php

namespace App\Form\Address;

use App\Dto\Address\AddressProvinceDTO;
use App\EntityInterface\Address\AddressCountryInterface;
use App\RepositoryInterface\Address\AddressProvinceRepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddressProvinceSelectorType extends AbstractType
{
    public function __construct(private readonly AddressProvinceRepositoryInterface $provinceRepository)
    {
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => function (Options $options): iterable {
                if (null === $options['country']) {
                    return $this->provinceRepository->findAll();
                }

                return $options['country']->getProvinces();
            },
            'choice_value' => 'code',
            'choice_label' => 'name',
            'choice_translation_domain' => false,
            'country' => null,
            'label' => 'form.address.province',
            'placeholder' => 'form.province.select',
            'data_class' => AddressProvinceDTO::class,

        ]);
        $resolver->addAllowedTypes('country', ['null', AddressCountryInterface::class]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'province_choice';
    }
}
