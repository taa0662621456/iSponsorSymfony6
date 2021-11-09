<?php
declare(strict_types=1);

namespace App\Form\Product;

use App\Entity\Product\ProductEnGb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{SubmitType, TextareaType, TextType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductEnGbType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productName', TextType::class, array(
            	'label' => 'label.product.name',
				'label_attr' => array(
					'class' => 'sr-only'
				),
				'required' => true,
				'attr' => array(
					'id'          => 'productName',
					'class'       => 'form-control m-1',
					'placeholder' => 'product.name.placeholder',
					'tabindex'    => '101',
					'autofocus'   => true
				)
			))
            ->add('productSDesc', TextareaType::class, array(
            	'label' => 'label.product.sdesc',
				'label_attr' => array(
					'class' => 'sr-only'
				),
				'required' => false,
				'attr' => array(
					'id'          => 'productSDesc',
					'class'       => 'form-control m-1',
					'placeholder' => 'product.sdesc.placeholder',
					'tabindex'    => '102',
					'autofocus'   => false
				)
			))
            ->add('productDesc', TextareaType::class, array(
            	'label' => 'label.product.desc',
				'label_attr' => array(
					'class' => 'sr-only'
				),
				'required' => false,
				'attr' => array(
					'id'          => 'productDesc',
					'class'       => 'form-control m-1',
					'placeholder' => 'product.desc.placeholder',
					'tabindex'    => '103',
					'autofocus'   => false
				)
			))
            ->add('slug', TextType::class, array(
            	'label' => 'label.product.slug',
				'label_attr' => array(
					'class' => 'sr-only'
				),
				'required' => false,
				'attr' => array(
					'id'          => 'slug',
					'class'       => 'form-control m-1',
					'placeholder' => 'product.tags.placeholder',
					'tabindex'    => '104',
					'autofocus'   => false
				)
				))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
			'data_class'         => ProductEnGb::class,
			'translation_domain' => 'product'
		]);
    }
}

