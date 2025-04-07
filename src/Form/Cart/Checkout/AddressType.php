<?php

namespace App\Form\Cart\Checkout;

use App\EntityInterface\Address\AddressInterface;
use App\EntityInterface\Customer\CustomerInterface;
use App\EntityInterface\Vendor\VendorInterface;
use Webmozart\Assert\Assert;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use App\Form\Customer\CustomerCheckoutGuestType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\EntityInterface\Address\AddressComparatorInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use const E_USER_DEPRECATED;

final class AddressType extends AbstractType
{
    private ?AddressComparatorInterface $addressComparator;

    protected string $dataClass;

    /** @var string[] */
    protected array $validationGroups = [];

    /**
     * @param string   $dataClass        FQCN
     * @param string[] $validationGroups
     */
    public function __construct(string $dataClass = 'data_class', array $validationGroups = [], AddressComparatorInterface $addressComparator = null)
    {
        $this->dataClass = $dataClass;
        $this->validationGroups = $validationGroups;

        if (null === $addressComparator) {
            @trigger_error(
                sprintf(
                    'Not passing an $addressComparator to "%s" constructor is deprecated since Sylius 1.8 and will be impossible in Sylius 2.0.',
                    __CLASS__,
                ),
                E_USER_DEPRECATED,
            );
        }

        $this->addressComparator = $addressComparator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('differentBillingAddress', CheckboxType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'sylius.form.checkout.addressing.different_billing_address',
            ])
            ->add('differentShippingAddress', CheckboxType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'sylius.form.checkout.addressing.different_shipping_address',
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, static function (FormEvent $event): void {
                $form = $event->getForm();

                Assert::isInstanceOf($event->getData(), OrderInterface::class);

                /** @var OrderInterface $order */
                $order = $event->getData();
                $vendor = $order->getVendor();

                $form
                    ->add('shippingAddress', self::class, [
                        'shippable' => true,
                        'constraints' => [new Valid()],
                        'channel' => $vendor,
                    ])
                    ->add('billingAddress', self::class, [
                        'constraints' => [new Valid()],
                        'channel' => $vendor,
                    ]);
            })
            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event): void {
                $form = $event->getForm();

                Assert::isInstanceOf($event->getData(), OrderInterface::class);

                /** @var OrderInterface $order */
                $order = $event->getData();
                $areAddressesDifferent = $this->areAddressesDifferent($order->getBillingAddress(), $order->getShippingAddress());

                $form->get('differentBillingAddress')->setData($areAddressesDifferent);
                $form->get('differentShippingAddress')->setData($areAddressesDifferent);
            })
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($options): void {
                $form = $event->getForm();
                $resource = $event->getData();
                $customer = $options['customer'];

                Assert::isInstanceOf($resource, CustomerAwareInterface::class);

                /** @var CustomerInterface|null $resourceCustomer */
                $resourceCustomer = $resource->getCustomer();

                if (
                    (null === $customer && null === $resourceCustomer)
                    || (null !== $resourceCustomer && null === $resourceCustomer->getUser())
                    || ($resourceCustomer !== $customer)
                ) {
                    $form->add('customer', CustomerCheckoutGuestType::class, ['constraints' => [new Valid()]]);
                }
            })
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($options): void {
                $orderData = $event->getData();

                /** @var VendorAwareInterface $order */
                $order = $options['data'];
                /** @var VendorInterface $vendor */
                $vendor = $order->getVendor();

                $differentBillingAddress = $orderData['differentBillingAddress'] ?? false;
                $differentShippingAddress = $orderData['differentShippingAddress'] ?? false;

                if ($differentBillingAddress || $differentShippingAddress) {
                    return;
                }

                if (isset($orderData['billingAddress']) && !$vendor->isShippingAddressInCheckoutRequired()) {
                    $orderData['shippingAddress'] = $orderData['billingAddress'];
                }

                if (isset($orderData['shippingAddress']) && $vendor->isShippingAddressInCheckoutRequired()) {
                    $orderData['billingAddress'] = $orderData['shippingAddress'];
                }

                $event->setData($orderData);
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefaults([
                'customer' => null,
            ]);
    }

    public function getBlockPrefix(): string
    {
        return 'checkout_address';
    }

    private function areAddressesDifferent(?AddressInterface $firstAddress, ?AddressInterface $secondAddress): bool
    {
        if (null === $this->addressComparator || null === $firstAddress || null === $secondAddress) {
            return false;
        }

        return !$this->addressComparator->equal($firstAddress, $secondAddress);
    }
}
