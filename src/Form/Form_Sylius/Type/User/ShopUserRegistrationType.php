<?php


namespace App\CoreBundle\Form\Type\User;



final class ShopUserRegistrationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'form.user.password.label'],
                'second_options' => ['label' => 'form.user.password.confirmation'],
                'invalid_message' => 'user.plainPassword.mismatch',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'shop_user_registration';
    }
}
