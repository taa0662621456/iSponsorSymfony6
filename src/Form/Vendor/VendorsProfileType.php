<?php
declare(strict_types=1);

namespace App\Form\Vendor;

use App\Entity\Vendor\Vendors;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class VendorsProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('vendorName', TextType::class, ['label' => 'vendorName'])
            ->add('email', EmailType::class, ['label' => 'email'])
            ->add('password', PasswordType::class, ['label' => 'password'])
            ->add('firstName', TextType::class, ['label' => 'firstName'])
            ->add('lastName', TextType::class, ['label' => 'firstName'])
            ->add('middleName', TextType::class, ['label' => 'firstName'])
            ->add('phone1')
            ->add('phone2')
            ->add('fax')
            ->add('address1')
            ->add('address2')
            ->add('city')
            ->add('stateId')
            ->add('countryId')
            ->add('zip')
            ->add('sendEmail', EmailType::class, ['label' => 'sendEmail'] )
            ->add('registerDate')
            ->add('lastVisitDate')
            ->add('lastResetTime')
            ->add('resetCount')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vendors::class,
        ]);
    }
}
