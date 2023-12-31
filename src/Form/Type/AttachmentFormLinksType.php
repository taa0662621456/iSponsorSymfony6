<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class AttachmentFormLinksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->create('AttachmentFormLinks', FormType::class, [
                'inherit_data' => true,
                'mapped' => false,
                'required' => false,
                'translation_domain' => 'label',
                'label' => false,
                'attr' => [
                    'class' => 'btn-group m-1',
                ],
            ])
            ->add('add_item_link', ButtonType::class, [
                'label' => 'Add file',
                'attr' => [
                    'data-collection-holder-class' => 'projectAttachments',
                    'class' => 'btn btn-primary add_item_link',

                ],
            ])
            ->add('rem_item_link', ButtonType::class, [
                'label' => 'Remove record',
                'attr' => [
                    'data-collection-holder-class' => 'projectAttachments',
                    'class' => 'btn btn-primary rem_item_link',

                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'translation_domain' => 'button',
            'label' => false,
        ]);
    }
}
