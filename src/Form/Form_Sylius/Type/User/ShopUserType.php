<?php


namespace App\CoreBundle\Form\Type\User;



final class ShopUserType extends UserType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->remove('username')
            ->remove('email')
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'shop_user';
    }
}
