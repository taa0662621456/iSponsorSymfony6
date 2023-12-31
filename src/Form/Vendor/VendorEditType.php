<?php

namespace App\Form\Vendor;

use App\Entity\Vendor\Vendor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VendorEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('locale', TextType::class, [
                'required' => false,
            ])
            ->add('vendorSecurity', VendorRegistrationType::class)
            ->add('vendorEnGb', VendorEnGbType::class)
            ->add('previous', SubmitType::class, [
                'label' => 'label.previous',
                'attr' => [
                    'id' => 'next',
                    'class' => 'btn btn-primary previous action-button-previous',
                ],
            ])
            ->add('next', SubmitType::class, [
                'label' => 'label.next',
                'attr' => [
                    'id' => 'next',
                    'class' => 'btn btn-primary next action-button',
                ],
            ])
            ->add('summit', SubmitType::class, [
                'label' => 'mail.sku',
                'attr' => [
                    'class' => 'btn btn-primary submit',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vendor::class,
            'attr' => [
                'id' => 'msform',
            ],
        ]);
    }
}
