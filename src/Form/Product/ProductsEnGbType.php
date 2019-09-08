<?php
declare(strict_types=1);

namespace App\Form\Product;

use App\Entity\Product\ProductsEnGb;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{SubmitType, TextareaType, TextType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsEnGbType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productName', TextType::class, ['label' => 'productName'])
            ->add('productSDesc', TextareaType::class, ['label' => 'productSDesc'])
            ->add('productDesc', TextareaType::class, ['label' => 'productDesc'])
            ->add('slug', TextType::class, ['label' => 'slug'])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductsEnGb::class,
        ]);
    }
}

