<?php


namespace App\Form\Product;

use App\Entity\Product\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
		$builder
            ->add('productSku', HiddenType::class, [
                    'required' => false
                ]
            )
            ->add('productEnGb', ProductEnGbType::class)
            ->add('productAttachments', CollectionType::class, [
                    'entry_type' => ProductAttachmentType::class,
                    'translation_domain' => 'product',
                    'label' => 'product.attachment.label',
                    'entry_options' => ['label' => false],
                    'required' => false,
                    //'empty_data' => true,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                ]
			)
            ->add('productTags', ProductTagType::class, [
                'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
			'data_class'         => Product::class,
			'translation_domain' => 'product',
			'attr'               => [
				'id' => 'msform',
                'class' => 'form-control m-1'
            ]
        ]);
    }
}
