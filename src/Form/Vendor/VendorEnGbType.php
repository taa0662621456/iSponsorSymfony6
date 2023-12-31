<?php

namespace App\Form\Vendor;

use App\Entity\Vendor\VendorEnUS;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Currencies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VendorEnGbType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $countries = Countries::getNames();
        $currencies = Currencies::getNames();
        $builder
            ->add('vendorFirstName', TextType::class, [
                'label' => 'label.first.name',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'required' => true,
                'attr' => [
                    'id' => 'vendorFirstName',
                    'class' => '',
                    'placeholder' => 'Enter Your first name',
                    'tabindex' => '101',
                    'autofocus' => true,
                ],
            ])
            ->add('vendorLastName', TextType::class, [
                'label' => 'label.last.name',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'required' => true,
                'attr' => [
                    'id' => 'lastName',
                    'class' => '',
                    'placeholder' => 'Enter Your last name',
                    'tabindex' => '102',
                    'autofocus' => false,
                ],
            ])
            ->add('vendorMiddleName', TextType::class, [
                'label' => 'label.middle.name',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'required' => false,
                'attr' => [
                    'id' => 'middleName',
                    'class' => '',
                    'placeholder' => 'Enter Your middle name',
                    'tabindex' => '103',
                    'autofocus' => false,
                ],
            ])
            ->add('vendorPhone', TelType::class, [
                'label' => 'label.phone.number',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'required' => false,
                'attr' => [
                    'id' => 'phoneNumber',
                    'class' => '',
                    'placeholder' => 'Enter Your phone number',
                    'tabindex' => '201',
                    'autofocus' => false,
                ],
            ])
            ->add('vendorSecondPhone', TelType::class, [
                'label' => 'label.second_phone.number',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'required' => false,
                'attr' => [
                    'id' => 'phoneSecond',
                    'class' => '',
                    'placeholder' => 'Enter Your second phone number',
                    'tabindex' => '202',
                    'autofocus' => false,
                ],
            ])
            ->add('vendorFax', TelType::class, [
                'label' => 'label.fax.number',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'required' => false,
                'attr' => [
                    'id' => 'faxNumber',
                    'class' => '',
                    'placeholder' => 'Enter Your fax number',
                    'tabindex' => '203',
                    'autofocus' => false,
                ],
            ])
            ->add('vendorAddress', TextType::class, [
                'label' => 'label.first.address',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'required' => false,
                'attr' => [
                    'id' => 'firstAddress',
                    'class' => '',
                    'placeholder' => 'Enter Your address',
                    'tabindex' => '301',
                    'autofocus' => false,
                ],
            ])
            ->add('vendorSecondAddress', TextType::class, [
                'label' => 'label.second.address',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'required' => false,
                'attr' => [
                    'id' => 'firstAddress',
                    'class' => '',
                    'placeholder' => 'Enter Your second address',
                    'tabindex' => '302',
                    'autofocus' => false,
                ],
            ])
            ->add('vendorCity', TextType::class, [
                'label' => 'label.city',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'required' => false,
                'attr' => [
                    'id' => 'firstAddress',
                    'class' => '',
                    'placeholder' => 'Enter Your city',
                    'tabindex' => '401',
                    'autofocus' => false,
                ],
            ])
            // ->add('stateId')
            ->add('vendorCountryId', ChoiceType::class, [
                // 'choices' => array_flip($countries),
                'choices' => $countries,
                'label' => 'Country',
                'label_attr' => [
                    'class' => '',
                ],
                'required' => false,
                'attr' => [
                    'id' => 'country',
                    'class' => '',
                    'placeholder' => 'Enter Your country name',
                    'tabindex' => '403',
                    'autofocus' => false,
                ],
            ])
            ->add('vendorZip', TextType::class, [
                'label' => 'label.zip',
                'label_attr' => [
                    'class' => 'sr-only',
                ],
                'required' => false,
                'attr' => [
                    'id' => 'zip',
                    'class' => '',
                    'placeholder' => 'Enter Your zip-code',
                    'tabindex' => '404',
                    'autofocus' => false,
                ],
            ])
            ->add('vendorCurrency', ChoiceType::class, [
                // 'choices' => array_flip($currencies),
                'choices' => $countries,
                'label' => 'label.currency',
                'label_attr' => [
                    'class' => '',
                ],
                'required' => false,
                'attr' => [
                    'id' => 'currency',
                    'class' => '',
                    'placeholder' => 'Enter Your main currency',
                    'tabindex' => '501',
                    'autofocus' => false,
                ],
            ])
            ->add('vendorAcceptedCurrencies', ChoiceType::class, [
                // 'choices' => array_flip($currencies),
                'choices' => $currencies,
                'label' => 'label.currency',
                'label_attr' => [
                    'class' => '',
                ],
                'required' => false,
                'attr' => [
                    'id' => 'accepted_currency',
                    'class' => '',
                    'placeholder' => 'Enter Your accepted currency',
                    'tabindex' => '502',
                    'autofocus' => false,
                ],
            ]);
        /*
        ->add('vendorParams')
        ->add('metaRobot')
        ->add('metaAuthor')
        ->add('createdBy')
        */
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VendorEnUS::class,
            'translation_domain' => 'vendor',
            'attr' => [
                'class' => 'needs-validation',
                'novalidate' => null,
            ],
        ]);
    }
}
