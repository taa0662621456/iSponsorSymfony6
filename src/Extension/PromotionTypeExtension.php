<?php


namespace App\CoreBundle\Form\Extension;



final class PromotionTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('channels', ChannelChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'label' => 'form.promotion.channels',
            ])
        ;
    }

    public function getExtendedType(): string
    {
        return PromotionType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [PromotionType::class];
    }
}
