<?php

namespace App\Form\Address;

use App\RepositoryInterface\Country\AddressCountryRepositoryInterface;
use App\Service\ResourceIdentifierTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ReversedTransformer;

final class AddressCountryCodeCollectionType extends AbstractType
{
    public function __construct(private readonly AddressCountryRepositoryInterface $countryRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder->addModelTransformer(new ReversedTransformer(new ResourceIdentifierTransformer($this->countryRepository, 'code')));
    }

    public function getParent(): string
    {
        return AddressCountryCollectionType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'country_code_choice';
    }
}
