<?php


namespace App\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductTaxonPositionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', IntegerType::class)
            ->add('position', IntegerType::class)
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'product_taxon_position';
    }
}
