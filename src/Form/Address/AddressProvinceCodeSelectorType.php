<?php


namespace App\Form\Address;


use Composer\Repository\RepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ReversedTransformer;

final class AddressProvinceCodeSelectorType extends AbstractType
{
    public function __construct(private readonly RepositoryInterface $provinceRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(new ReversedTransformer(new ResourceToIdentifierTransformer($this->provinceRepository, 'code')));
    }

    public function getParent(): string
    {
        return AddressProvinceSelectorType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'province_code_choice';
    }
}
