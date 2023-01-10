<?php

namespace App\Form\Address;

use App\Interface\RepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddressSelectorType extends AbstractType
{
    public function __construct(private readonly RepositoryInterface $addressRepository)
    {
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => function (Options $options): array {
                if (null === $options['customer']) {
                    return $this->addressRepository->findAll();
                }

                return $this->addressRepository->findByCustomer($options['customer']);
            },
            'choice_value' => 'id',
            'choice_translation_domain' => false,
            'customer' => null,
            'label' => false,
            'placeholder' => false,
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'address_choice';
    }
}
