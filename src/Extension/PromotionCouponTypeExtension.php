<?php


namespace App\Extension;



use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

final class PromotionCouponTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('perCustomerUsageLimit', IntegerType::class, [
                'label' => 'form.promotion_coupon.per_customer_usage_limit',
                'required' => false,
            ])
            ->add('reusableFromCancelledOrders', CheckboxType::class, [
                'label' => 'form.promotion_coupon.reusable_from_cancelled_orders',
                'required' => false,
            ])
        ;
    }

    public function getExtendedType(): string
    {
        return PromotionCouponType::class;
    }

    public static function getExtendedTypes(): iterable
    {
        return [PromotionCouponType::class];
    }
}
