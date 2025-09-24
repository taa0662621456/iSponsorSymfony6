<?php


namespace App\Form\Product;

use App\Entity\Product\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function __construct(private readonly string $token = 'No $token?! Must be initialized to parameters.yaml or service.yaml and service.bind:$token')
    {

    }

    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
		$builder
            ->add('productSku', HiddenType::class, [
                    'required' => false
                ])
            ->add('productEnGb', ProductEnGbType::class, [
                ])
            ->add('productAttachment', CollectionType::class, [
                    'entry_type' => ProductAttachmentType::class,
                    'translation_domain' => 'product',
                    'label' => 'product.attachment.label',
                    'entry_options' => ['label' => false],
                    'required' => false,
                    'empty_data' => '',
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                ])
            ->add(
                $builder
                    ->create('attachmentFormLinks', FormType::class, [
                        'label' => false,
                        'mapped' => false,
                        'required' => false,
                        'attr' => [
                            'class' => 'btn-group m-1'
                        ]
                    ])
                    ->add('add_item_link', ButtonType::class, [
                        'label' => 'Add file',
                        'attr' => [
                            'data-collection-holder-class' => 'productAttachment',
                            'class' => 'btn btn-primary add_item_link',

                        ]
                    ])
                    ->add('rem_item_link', ButtonType::class, [
                        'label' => 'Remove record',
                        'attr' => [
                            'data-collection-holder-class' => 'productAttachment',
                            'class' => 'btn btn-primary rem_item_link',

                        ]
                    ])
            )
            ->add('productTag', ProductTagType::class, [
                'label' => false,
                'required' => false,
                'empty_data' => '',

            ])
            ->add(
                $builder
                    ->create('button_group', FormType::class, [
                        'translation_domain' => 'button',
                        'inherit_data' => true,
                        'label' => false,
                        'attr'=> [
                            'class' => 'btn-group mt-3'
                        ]
                    ])
                    ->add('submit', SubmitType::class, [
                        'translation_domain' => 'button',
                        'label' => 'button.submit.new.product.label',
                        'attr'  => [
                            'class' => 'w-100 btn btn-primary btn-block',
                            'label' => 'button.submit.label.add'
                        ]
                    ])
                    ->add('back', ButtonType::class, [
                        'translation_domain' => 'button',
                        'label' => 'button.label.back',
                        'attr'  => [
                            'class' => 'btn btn-link btn-sm back',
                            //'onclick' => 'window.history.back()'
                        ]
                    ])
                    ->add('cancel', ButtonType::class, [
                        'translation_domain' => 'button',
                        'label' => 'button.label.cancel',
                        'attr' => [
                            'class' => 'btn btn-link btn-sm signup',
                            //'onclick' => 'window.location.href=\'/registration\''
                        ]
                    ])
            )
            ->add('token', HiddenType::class, [
                'mapped' => false,
                'attr' => [
                    'name' => '_csrf_token',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
			'data_class'         => Product::class,
			'translation_domain' => 'product',
            'trim' => true,
            'csrf_protection'    => true,
            'csrf_field_name'    => '_csrf_token',
            'csrf_token_id'      => $this->token,
			'attr'               => [
				'id' => '',
                'class' => 'needs-validation',
                'novalidate' => null,
            ]
        ]);
    }
}