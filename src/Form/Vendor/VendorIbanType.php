<?php

namespace App\Form\Vendor;

use App\Entity\Vendor\VendorIban;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VendorIbanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vendorIban')
            ->add('iban');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VendorIban::class,
            'translation_domain' => 'vendor',
        ]);
    }
}
