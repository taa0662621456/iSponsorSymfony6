<?php


namespace App\Extension;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CartTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('shippingAddress', AddressType::class)
            ->add('billingAddress', AddressType::class)
            ->add('promotionCoupon', PromotionCouponToCodeType::class, [
                'by_reference' => false,
                'label' => 'form.cart.coupon',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setNormalizer('validation_groups', fn (Options $options, array $validationGroups) => function (FormInterface $form) use ($validationGroups) {
            if ((bool) $form->get('promotionCoupon')->getNormData()) { // Validate the coupon if it was sent
                $validationGroups[] = 'promotion_coupon';
            }

            return $validationGroups;
        });
    }

    public function getExtendedType(): string
    {
        return CartType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [CartType::class];
    }
}