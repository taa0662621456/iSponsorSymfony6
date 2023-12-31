<?php

namespace App\Form\Vendor\TypeFromSylius;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

final class UserLoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('_username', TextType::class, [
                'label' => 'form.user.email',
            ])
            ->add('_password', PasswordType::class, [
                'label' => 'form.user.password.label',
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'user_security_login';
    }
}
