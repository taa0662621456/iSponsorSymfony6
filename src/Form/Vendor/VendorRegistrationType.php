<?php
declare(strict_types=1);

namespace App\Form\Vendor;

use App\Entity\Vendor\Vendor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VendorRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
			->add('vendorSecurity', VendorSecurityType::class, [
			    'label' => 'vendor.registration'
            ])
			->add('submit', SubmitType::class, [
                'translation_domain' => 'button',
                'label' => 'button.label.registration',
                'attr'  => [
                    'class' => 'btn btn-primary btn-block'
                ]
                ]
			)
            ->add('token', HiddenType::class, [
                'mapped' => false,
                'attr' => [
                    'name' => '_csrf_token',
                ]
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
			'data_class'         => Vendor::class,
			'csrf_protection'    => true,
			'csrf_field_name'    => '_csrf_token',
			'csrf_token_id'      => 'ZGZnZGZnZGZnIGdkZmcgZGZnIGRmZyBkZyA=',
			'translation_domain' => 'vendor'
        ]);
    }
}
