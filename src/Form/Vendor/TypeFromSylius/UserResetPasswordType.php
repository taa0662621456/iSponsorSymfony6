<?php

namespace App\Form\Vendor\TypeFromSylius;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;

final class UserResetPasswordType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'form.user.password.label'],
                'second_options' => ['label' => 'form.user.password.confirmation'],
                'invalid_message' => 'user.plainPassword.mismatch',
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'user_reset_password';
    }
}
