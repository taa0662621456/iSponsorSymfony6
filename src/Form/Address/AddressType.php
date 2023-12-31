<?php

namespace App\Form\Address;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class AddressType extends AbstractType
{
    protected string $dataClass;

    /** @var string[] */
    protected array $validationGroups = [];

    /**
     * @param string   $dataClass        FQCN
     * @param string[] $validationGroups
     */
    // public function __construct(private readonly EventSubscriberInterface $buildAddressFormSubscriber,
    public function __construct(
        array $validationGroups = [],
        string $dataClass = 'data_class'
    ) {
        $this->dataClass = $dataClass;
        $this->validationGroups = $validationGroups;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'form.address.first_name',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'form.address.last_name',
            ])
            ->add('phoneNumber', TextType::class, [
                'required' => false,
                'label' => 'form.address.phone_number',
            ])
            ->add('company', TextType::class, [
                'required' => false,
                'label' => 'form.address.company',
            ])
            ->add('countryCode', CountryCodeChoiceType::class, [
                'label' => 'form.address.country',
                'enabled' => true,
            ])
            ->add('street', TextType::class, [
                'label' => 'form.address.street',
            ])
            ->add('city', TextType::class, [
                'label' => 'form.address.city',
            ])
            ->add('postcode', TextType::class, [
                'label' => 'form.address.postcode',
            ]);
        // ->addEventSubscriber($this->buildAddressFormSubscriber)
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefaults([
                'validation_groups' => function (Options $options) {
                    if ($options['shippable']) {
                        return array_merge($this->validationGroups, ['shippable']);
                    }

                    return $this->validationGroups;
                },
                'shippable' => false,
            ])
            ->setAllowedTypes('shippable', 'bool');
    }

    public function getBlockPrefix(): string
    {
        return 'address';
    }
}
