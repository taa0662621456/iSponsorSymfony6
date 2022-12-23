<?php

namespace App\CoreBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

abstract class ImageType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', TextType::class, [
                'label' => 'form.image.type',
                'required' => false,
            ])
            ->add('file', FileType::class, [
                'label' => 'form.image.file',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'image';
    }
}
