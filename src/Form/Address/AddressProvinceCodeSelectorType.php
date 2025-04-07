<?php

namespace App\Form\Address;

use App\Dto\Address\AddressProvinceDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\RepositoryInterface\Address\AddressProvinceRepositoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddressProvinceCodeSelectorType extends AbstractType
{
    public function __construct(private readonly AddressProvinceRepositoryInterface $addressProvinceRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('provinceCode', ChoiceType::class, [
            'choices' => $this->getProvinceCodeChoices(),
            'choice_label' => 'name',
            'choice_value' => 'code',
            'data_class' => AddressProvinceDTO::class,
        ]);
        // $builder->addModelTransformer(new ReversedTransformer(new ResourceToIdentifierTransformer($this->addressProvinceRepository, 'code')));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AddressProvinceDTO::class,
        ]);
    }

    private function getProvinceCodeChoices(): array
    {
        $provinces = $this->addressProvinceRepository->findAll();

        $choices = [];
        foreach ($provinces as $province) {
            $choices[$province->getName()] = $province->getCode();
        }

        return $choices;
    }

    public function getParent(): string
    {
        return AddressProvinceSelectorType::class;
    }

    public function getBlockPrefix(): string
    {
        // return strtolower((new \ReflectionClass($this))->getShortName());
        return 'address_province_code_selector';
    }
}
