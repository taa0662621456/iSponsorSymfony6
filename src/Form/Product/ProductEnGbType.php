<?php


namespace App\Form\Product;

use App\Entity\Product\ProductEnGb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{SubmitType, TextareaType, TextType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductEnGbType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productName', TextType::class, [
//            	'label' => 'label.product.name',
            	'label' => false,
                'invalid_message' => 'product.message.name.invalid',
                'constraints'     => [
                    new NotBlank([
                        'message' => 'product.message.empty',
                    ]),
                    new Length([
                        'min' => 30,
                        'minMessage' => 'Название не может быть  {{ limit }} characters',
                        'max' => 255,
                        'maxMessage' => 'Название не может быть больше  {{ limit }} characters',

                    ])
                    ],
				'label_attr' => [
					'class' => ''
                ],
				'required' => true,
                'empty_data' => '',
				'attr' => [
					'id'          => 'productName',
					'class'       => 'form-control m-1',
					'placeholder' => 'product.name.placeholder',
					'tabindex'    => '101',
					'autofocus'   => true,
                    'minlength' => 56,
                    'maxlength' => 255,
                ]
            ])
            ->add('productSDesc', TextareaType::class, [
//            	'label' => 'product.label.sdesc',
                'label' => false,
				'label_attr' => [
					'class' => 'sr-only'
                ],
                'invalid_message' => 'product.message.s.desc.invalid',
                'constraints'     => [
                    new NotBlank([
                        'message' => 'product.message.s.desc.empty',
                    ]),
                    new Length([
                        'min' => 56,
                        'minMessage' => 'Краткое описание не может быть менее  {{ limit }} characters',
                        'max' => 512,
                        'maxMessage' => 'Краткое описание не может быть больше  {{ limit }} characters',

                    ])
                ],
				'required' => false,
                'empty_data' => '',
                'attr' => [
					'id'          => 'productSDesc',
					'class'       => 'form-control m-1',
					'placeholder' => 'product.sdesc.placeholder',
					'tabindex'    => '102',
					'autofocus'   => false,
                    'minlength' => 56,
                    'maxlength' => 512,
                ]
            ])
            ->add('productDesc', TextareaType::class, [
//            	'label' => 'label.product.desc',
                'label' => false,
				'label_attr' => [
					'class' => ''
                ],
                'invalid_message' => 'product.message.desc.invalid',
                'constraints'     => [
                    new NotBlank([
                        'message' => 'product.message.desc.empty',
                    ]),
                    new Length([
                        'min' => 512,
                        'minMessage' => 'Описание не может быть менее {{ limit }} characters',
                        'max' => 15000,
                        'maxMessage' => 'Описание не может быть больше {{ limit }} characters',

                    ])
                ],
				'required' => false,
                'empty_data' => '',
                'attr' => [
					'id'          => 'productDesc',
					'class'       => 'form-control m-1',
					'placeholder' => 'product.desc.placeholder',
					'tabindex'    => '103',
					'autofocus'   => false,
                    'minlength' => 512,
                    'maxlength' => 15000,
                ]
            ])
            ->add('slug', TextType::class, [
//            	'label' => 'label.product.slug',
                'label' => false,
				'label_attr' => [
					'class' => ''
                ],
                'invalid_message' => 'product.message.slug.invalid',
                'constraints'     => [
                    new NotBlank([
                        'message' => 'product.message.slug.empty',
                    ]),
                    new Length([
                        'min' => 30,
                        'minMessage' => 'Slug не может быть  {{ limit }} characters',
                        'max' => 132,
                        'maxMessage' => 'Slug не может быть больше {{ limit }} characters',

                    ])
                ],
				'required' => false,
                'empty_data' => '',
                'attr' => [
					'id'          => 'slug',
					'class'       => 'form-control m-1',
					'placeholder' => 'product.tags.placeholder',
					'tabindex'    => '104',
					'autofocus'   => false,
                    'minlength' => 16,
                    'maxlength' => 255,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
			'data_class'         => ProductEnGb::class,
			'translation_domain' => 'product',
            'required' => true,
            'label' => false,
//            'empty_data' => function (FormInterface $form) {
//                return new ProductEnGb($form->get('title')->getData());
//            },
		]);
    }
}
