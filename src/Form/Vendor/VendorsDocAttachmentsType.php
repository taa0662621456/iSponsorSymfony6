<?php
declare(strict_types=1);

namespace App\Form\Vendor;

use App\Entity\Vendor\Vendors;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VendorsDocAttachmentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('vendorsDocAttachments',CollectionType::class, array(
                'entry_type' => VendorsDocAttachmentsType::class,
                'data_class' => null,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'prototype' => true
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => Vendors::class,
        ]);
    }
}
