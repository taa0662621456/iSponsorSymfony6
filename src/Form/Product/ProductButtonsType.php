<?php

namespace App\Form\Product;

use App\Entity\Product\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductButtonsType extends AbstractType
{
    public function __construct(private readonly string $token = 'No $token?! Must be initialized to parameters.yaml or service.yaml and service.bind:$token')
    {

    }

    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add(
                $builder
                    ->create('button_group', FormType::class, [
                        'translation_domain' => 'button',
                        'inherit_data' => true,
                        'label' => false,
                        'attr'=> [
                            'class' => 'btn-group'
                        ]
                    ])
                    ->add('submit', SubmitType::class, [
                        'translation_domain' => 'button',
                        'label' => 'button.submit.label',
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
/*			'data_class'         => Product::class,*/
            'trim' => true,
            'csrf_protection'    => true,
            'csrf_field_name'    => '_csrf_token',
            'csrf_token_id'      => $this->token,
            'translation_domain' => 'product',
            'row_attr' => [
                'class' => 'mb-0'
            ],
            'attr' => [
                'class' => 'needs-validation',
                'novalidate' => null,
            ]
        ]);
    }
}
