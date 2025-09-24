<?php


namespace App\Extension;


use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class ProductTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('channels', ChannelChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'label' => 'form.product.channels',
            ])
            ->add('mainTaxon', TaxonAutocompleteChoiceType::class, [
                'label' => 'form.product.main_taxon',
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
                $product = $event->getData();
                $form = $event->getForm();

                $form->add('productTaxons', ProductTaxonAutocompleteChoiceType::class, [
                    'label' => 'form.product.taxons',
                    'product' => $product,
                    'multiple' => true,
                ]);
            })
            ->add('variantSelectionMethod', ChoiceType::class, [
                'choices' => array_flip(Product::getVariantSelectionMethodLabels()),
                'label' => 'form.product.variant_selection_method',
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => ProductImageType::class,
                'entry_options' => ['product' => $options['data']],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'form.product.images',
                'block_name' => 'entry',
            ])
        ;
    }

    public function getExtendedType(): string
    {
        return ProductType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [ProductType::class];
    }
}