<?php


namespace App\Extension;



final class CatalogPromotionTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('channels', ChannelChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'label' => 'form.catalog_promotion.channels',
                'required' => false,
            ])
        ;
    }

    public function getExtendedType(): string
    {
        return CatalogPromotionType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [CatalogPromotionType::class];
    }
}
