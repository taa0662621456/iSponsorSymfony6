<?php
declare(strict_types=1);

namespace App\Form\Vendor;

use App\Entity\Vendor\VendorsSecurity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VendorsSecurityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('email', EmailType::class, array(
				'invalid_message' => 'The email address is invalid.',
				'label'           => 'vendor.label.email',
				'label_attr'      => array(
					'class' => 'sr-only',
					'value' => 'last_username'
				),
				'required'        => true,
				'attr'            => array(
					'id'          => 'email',
					'name'        => '_email',
					'class'       => 'form-control',
					'placeholder' => 'vendor.placeholder.email',
					'tabindex'    => '101',
					//'autofocus' => true
				),
            ))
            ->add('plainPassword', RepeatedType::class, array(
				'invalid_message' => 'The password is invalid.',
				'type'            => PasswordType::class,
				'first_options'   => array(
					'label'      => 'vendor.label.password',
					'label_attr' => array(
						'class' => 'sr-only',
					),
					'attr'       => array(
						'class'       => '',
						'placeholder' => 'vendor.placeholder.password',
						'tabindex'    => '201'
					)
				),
                'second_options' => array(
					'label'      => 'vendor.label.password.confirm',
					'label_attr' => array(
						'class' => 'sr-only'
					),
					'attr'       => array(
						'class'       => '',
						'placeholder' => 'vendor.placeholder.password.confirm',
						'tabindex'    => '202'
					)
				),
                'required' => true,
                'attr' => array(
                    'id' => 'password',
                    'name' => '_password',
                    'class' =>'form-control',
                    'placeholder' => 'Password',
					'tabindex' => '203'
                )
            ))
            ->add('phone', TelType::class, array(
                'label' => 'vendor.label.phone',
                'label_attr' => array(
                    'class' => 'sr-only'
                ),
                'attr' => array(
                    'placeholder' => 'vendor.placeholder.phone'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
			'data_class'         => VendorsSecurity::class,
			'translation_domain' => 'vendor'
		]);
    }
}
