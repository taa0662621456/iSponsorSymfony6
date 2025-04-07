<?php

namespace App\Form\Shipment\TypeSylius;

use App\EventSubscriber\AddCodeFormSubscriber;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

final class ShippingCategoryType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->add('name', TextType::class, [
                'label' => 'form.shipping_category.name',
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'form.shipping_category.description',
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'shipping_category';
    }
}
