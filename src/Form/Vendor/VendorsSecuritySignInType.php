<?php
declare(strict_types=1);

namespace App\Form\Vendor;

use App\Entity\Vendor\VendorsSecurity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VendorsSecuritySignInType extends AbstractType
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
                'autofocus' => true,
                'attr' => array(
                    'id' => 'email',
                    'name' => '_email',
                    'class' => 'form-control',
                    'placeholder' => 'exemple@yahoo.com'
                ),
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'label' => 'label.password',
                'label_attr' => array(
                    'class' => 'sr-only'
                ),
                'required' => true,
                'attr' => array(
                    'id' => 'password',
                    'name' => '_password',
                    'class' =>'form-control',
                    'placeholder' => 'Password'
                ),
            ))
            ->add('', CheckboxType::class, array(
                'label' => 'label.remember',
                'required' => false,
                'label_attr'=> array(
                    'class' => ''
                ),
                'attr'=> array(
                    'id' => 'remember_me',
                    'name' => '_remember_me',
                    'class' => ''
                ),
            ))
            ->add('submit', SubmitButton::class, array(
                'label' => 'form.signin.submit',
                'attr' => array(
                    'class' => 'btn btn-primary btn-block'
                )
            ))
            ->add('token', HiddenType::class, array(
                'attr' => array(
                    'name' => '_csrf_token'
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults(array(
            'data_class' => VendorsSecurity::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_csrf_token',
            'csrf_token_id'   => '6cb546b7fb9e056773030920402e4172'
        ));
    }
}