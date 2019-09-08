<?php
declare(strict_types=1);

namespace App\Form\Product;

use App\Entity\Product\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('vendorId')
            /*
            ->add('productParentId')
            ->add('productSku')
            ->add('productGtin')
            ->add('productMpn')
            ->add('productWeight')
            ->add('productWeightUom')
            ->add('productLength')
            ->add('productWidth')
            ->add('productHeight')
            ->add('productLwhUom')
            ->add('productInStock')
            ->add('productOrdered')
            ->add('productStockHandle')
            ->add('lowStockNotification')
            ->add('productAvailableDate')
            ->add('productAvailability')
            ->add('productSpecial')
            ->add('productDiscontinued')
            ->add('productSales')
            ->add('productUnit')
            ->add('productPackaging')
            ->add('productParams')
            ->add('productCanonCategoryId')
            ->add('hits')
            ->add('intNotes')
            ->add('metaRobot')
            ->add('metaAuthor')
            ->add('layout')
            ->add('published')

            ->add('ordering')
            ->add('createdOn')
            ->add('createdBy')
            ->add('modifiedOn')
            ->add('modifiedBy')
            ->add('lockedOn')
            ->add('lockedBy')
            */
            ->add('productEnGb', ProductsEnGbType::class)
            ->add('productsAttachments', ProductsAttachmentsType::class)
            ->add('tags', ProductsTagsType::class, array(
                'required' => false
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
