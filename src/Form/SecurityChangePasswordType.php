<?php


namespace App\Form;


use App\Entity\Vendor\Vendors;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SecurityChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('vendorName', TextType::class, ['label' => 'vendorName'])
//            ->add('email', EmailType::class, ['label' => 'email'])
            ->add('password', PasswordType::class, ['label' => 'password'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vendors::class,
        ]);
    }
}
