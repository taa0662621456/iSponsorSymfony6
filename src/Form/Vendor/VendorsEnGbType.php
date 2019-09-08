<?php
declare(strict_types=1);

namespace App\Form\Vendor;

use App\Entity\Vendor\VendorsEnGb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Intl\Intl;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VendorsEnGbType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $countries = Intl::getRegionBundle()->getCountryNames();
        $currencies = Intl::getCurrencyBundle()->getCurrencyNames();
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('middleName')
            ->add('phone')
            ->add('phoneSecond')
            ->add('fax')
            ->add('address')
            ->add('addressSecond')
            ->add('city')
            //->add('stateId')
            ->add('countryId', ChoiceType::class, array(
                //'choices' => array_flip($countries),
                'choices' => Intl::getRegionBundle()->getCountryNames(),
                'label'=>'Country'))
            ->add('zip')
            ->add('vendorCurrency', ChoiceType::class, array(
                //'choices' => array_flip($currencies),
                'choices' => Intl::getRegionBundle()->getCountryNames(),
                'label'=>'Main currency'))

            ->add('vendorAcceptedCurrencies', ChoiceType::class, array(
                //'choices' => array_flip($currencies),
                'choices' => Intl::getCurrencyBundle()->getCurrencyNames(),
                'label'=>'Accepted currency'))
            /*
            ->add('vendorParams')
            ->add('metaRobot')
            ->add('metaAuthor')
            ->add('createdOn')
            ->add('createdBy')
            ->add('modifiedOn')
            ->add('modifiedBy')
            ->add('lockedOn')
            ->add('lockedBy')
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => VendorsEnGb::class,
        ]);
    }
}
