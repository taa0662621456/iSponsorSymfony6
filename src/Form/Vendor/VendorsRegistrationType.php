<?php
declare(strict_types=1);

namespace App\Form\Vendor;

use App\Entity\Vendor\Vendors;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VendorsRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
			->add('vendorSecurity', VendorsSecurityType::class, array(
			    'label' => 'form.label.registration'
            ))
			->add('submit', SubmitType::class, array(
					'label' => 'button.label.registration',
					'attr'  => array(
						'class' => 'btn btn-primary btn-block'
					)
				)
			)
            ->add('token', HiddenType::class, array(
                'mapped' => false,
                'attr' => array(
                    'name' => '_csrf_token',
                )
            ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults(array(
			'data_class'         => Vendors::class,
			'csrf_protection'    => true,
			'csrf_field_name'    => '_csrf_token',
			'csrf_token_id'      => 'ZGZnZGZnZGZnIGdkZmcgZGZnIGRmZyBkZyA=',
			'translation_domain' => 'vendor'
		));
    }
}