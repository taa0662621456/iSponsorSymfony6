<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlatformLangType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('assetId')
            ->add('langCode')
            ->add('title')
            ->add('titleNative')
            ->add('sef')
            ->add('image')
            ->add('description')
            ->add('metakey')
            ->add('metadesc')
            ->add('sitename')
            ->add('published')
            //->add('access')
            //->add('ordering')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            //'data_class' => PlatformLang::class,//TODO: сущность еще не создана. Необховдима для хранения в базе поддерживаемых локализаций
        ]);
    }
}
