<?php


namespace App\CoreBundle\Form\Extension;



final class TaxonTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('images', CollectionType::class, [
                'entry_type' => TaxonImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'form.taxon.images',
            ])
        ;
    }

    public function getExtendedType(): string
    {
        return TaxonType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [TaxonType::class];
    }
}
