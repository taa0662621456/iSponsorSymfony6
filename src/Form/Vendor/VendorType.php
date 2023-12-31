<?php

namespace App\Form\Vendor;

use App\Entity\Vendor\Vendor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VendorType extends AbstractType
{
    public function __construct(private readonly string $token = 'No $token?! Must be initialized to parameters.yaml or service.yaml and service.bind:$token')
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('locale', HiddenType::class, [
                'required' => false,
            ])
            ->add('vendorSecurity', VendorEnGbType::class, [
                'label' => false,
            ])
//            ->add('vendorSecurity', VendorAttachmentType::class, [
//                'label' => false
//            ])
            ->add('submit', SubmitType::class, [
                'translation_domain' => 'button',
                'label' => 'button.vendor.new.label',
                'attr' => [
                    'class' => 'btn btn-primary btn-block',
                    'label' => 'button.vendor.new.label',
                ],
            ])
            ->add('token', HiddenType::class, [
                'mapped' => false,
                'attr' => [
                    'name' => '_csrf_token',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'translation_domain' => 'vendor',
            'data_class' => Vendor::class,
            'trim' => true,
            'csrf_protection' => true,
            'csrf_field_name' => '_csrf_token',
            'csrf_token_id' => $this->token,
            'row_attr' => [
                'class' => 'mb-0',
            ],
            'attr' => [
                'class' => 'needs-validation',
                'novalidate' => null,
            ],
        ]);
    }
}
