<?php


namespace App\Form\Vendor\TypeFromSylius;



final class UserRequestPasswordResetType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'form.user.email',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'user_request_password_reset';
    }
}