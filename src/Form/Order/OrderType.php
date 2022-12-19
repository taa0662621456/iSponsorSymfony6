<?php


namespace App\Form\Order;

use App\Entity\Order\OrderStorage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('vendorId')
            /*
            ->add('orderNumber')
            ->add('customerNumber')
            ->add('orderPass')
            ->add('orderCreateInvoicePass')
            ->add('orderTotal')
            ->add('orderSalesPrice')
            ->add('orderBillTaxAmount')
            ->add('orderBillTax')
            ->add('orderBillDiscountAmount')
            ->add('orderBillDiscount')
            ->add('orderSubtotal')
            ->add('orderTax')
            ->add('orderShipment')
            ->add('orderShipmentTax')
            ->add('orderPayment')
            ->add('orderPaymentTax')
            ->add('couponDiscount')
            ->add('couponCode')
            ->add('orderDiscount')
            ->add('orderCurrency')
            ->add('orderStatus')
            ->add('userCurrencyId')
            ->add('userCurrencyRate')
            ->add('userShopperGroups')
            ->add('paymentCurrencyId')
            ->add('paymentCurrencyRate')
            ->add('PaymentMethodId')
            ->add('ShipmentMethodId')
            ->add('deliveryDate')
            ->add('orderLanguage')
            ->add('ipAddress')
            ->add('STSameAsBT')
            ->add('oHash')
            ->add('createdAt')
            ->add('createdBy')
            ->add('modifiedOn')
            ->add('modifiedBy')
            ->add('lockedOn')
            ->add('lockedBy')
            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => OrderStorage::class,
        ]);
    }
}
