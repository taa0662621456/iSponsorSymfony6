<?php


namespace App\Form\Address;


use Composer\Repository\RepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ReversedTransformer;

final class AddressCountryCodeCollectionType extends AbstractType
{
    public function __construct(private readonly RepositoryInterface $countryRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(new ReversedTransformer(new ResourceToIdentifierTransformer($this->countryRepository, 'code')));
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