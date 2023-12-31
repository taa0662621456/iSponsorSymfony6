<?php

namespace App\Form\Customer;

use Symfony\Component\Form\AbstractType;

final class CustomerCheckoutGuestType extends AbstractType
{
    //    protected string $dataClass;
    //
    //
    //    /**
    //     * @param string   $dataClass        FQCN
    //     * @param string[] $validationGroups
    //     */
    //    public function __construct(
    //        private readonly VendorFactoryInterface $vendorFactory,
    //        private readonly array $validationGroups = [],
    //        string $dataClass = 'data_class',
    //    ) {
    //        $this->dataClass = $dataClass;
    //    }
    //
    //    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    //    {
    //        $customer = '';
    //        $builder
    //            ->add('email', EmailType::class, [
    //                'label' => 'form.customer.email',
    //            ])
    //            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($customer): void {
    //                $data = $event->getData();
    //
    //                if (!isset($data['email'])) {
    //                    return;
    //                }
    //
    // //                $emailCanonical = $this->canonicalizer->canonicalize($data['email']);
    // //
    // //                /** @var CustomerInterface|null $customer */
    // //                $customer = $this->vendorRepository->findOneBy(['emailCanonical' => $emailCanonical]);
    //
    //                // assign existing customer or create a new one
    //                if (null === $customer) {
    //                    /** @var CustomerInterface $customer */
    //                    $customer = $this->vendorFactory->createNew();
    //                    $customer->setEmail($data['email']);
    //                }
    //
    //                $form = $event->getForm();
    //                $form->setData($customer);
    //            })
    //            ->setDataLocked(false)
    //        ;
    //    }
    //
    //    public function getBlockPrefix(): string
    //    {
    //        return 'customer_checkout_guest';
    //    }
}
