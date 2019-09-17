<?php
declare(strict_types=1);

namespace App\Form\Vendor;

use App\Entity\Vendor\VendorsSecurity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VendorsSecurityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'label.email',
                'label_attr' => array(
                    'class' => 'sr-only'
                ),
                'required' => true,
                'attr' => array(
                    'id' => 'email',
                    'name' => '_email',
                    'class' => 'form-control',
                    'placeholder' => 'exemple@yahoo.com',
					'tabindex' => '101',
                    'autofocus' => true
                ),
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array(
                    'label' => 'label.password',
                    'label_attr' => array(
                    'class' => 'sr-only',
                    ),
                    'attr' => array(
                        'class' => '',
                        'placeholder' => 'placeholder.password.enter',
						'tabindex' => '201'
                    )
                ),
                'second_options' => array(
                    'label' => 'label.repeat.password',
                    'label_attr' => array(
                        'class' => 'sr-only'
                    ),
                    'attr' => array(
                        'class' => '',
                        'placeholder' => 'placeholder.password.confirm',
						'tabindex' => '202'
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => VendorsSecurity::class,
        ]);
    }
}
