<?php
declare(strict_types=1);

namespace App\Form\Product;

use App\Entity\Product\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
		$builder
			->add(
				'productSku', HiddenType::class, array(
					'required' => false
				)
			)
			->add('productEnGb', ProductsEnGbType::class)
			->add(
				'productAttachments', CollectionType::class, array(
					'entry_type'         => ProductsAttachmentsType::class,
					'label'              => 'product.attachment.label',
					'translation_domain' => 'product',
					'entry_options'      => array('label' => false),
					'required'           => false,
					//'empty_data' => true,
					'allow_add'          => true,
					'allow_delete'       => true,
					'prototype'          => true,
				)
			)
            ->add('productTags', ProductsTagsType::class, array(
                'required' => false
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults(array(
            'data_class' => Products::class,
			'attr' => array(
				//'id' => 'msform'
			)
		));
    }
}
