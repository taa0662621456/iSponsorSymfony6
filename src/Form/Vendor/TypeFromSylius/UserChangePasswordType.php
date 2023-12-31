<?php

namespace App\Form\Vendor\TypeFromSylius;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

final class UserChangePasswordType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentPassword', PasswordType::class, [
                'label' => 'form.user_change_password.current',
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'form.user_change_password.new'],
                'second_options' => ['label' => 'form.user_change_password.confirmation'],
                'invalid_message' => 'user.plainPassword.mismatch',
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'user_change_password';
    }
}
