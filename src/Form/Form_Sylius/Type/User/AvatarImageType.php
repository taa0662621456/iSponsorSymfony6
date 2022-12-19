<?php


namespace App\CoreBundle\Form\Type\User;



final class AvatarImageType extends ImageType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->remove('type')
            ->add('file', FileType::class, [
                'label' => 'form.image.file',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'avatar_image';
    }
}
