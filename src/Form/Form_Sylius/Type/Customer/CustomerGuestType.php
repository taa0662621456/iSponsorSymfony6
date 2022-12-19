<?php


namespace App\CoreBundle\Form\Type\Customer;





use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class CustomerGuestType extends AbstractResourceType
{
    public function __construct(
        string $dataClass,
        array $validationGroups,
        private RepositoryInterface $customerRepository,
        private FactoryInterface $customerFactory,
        private CanonicalizerInterface $canonicalizer,
    ) {
        parent::__construct($dataClass, $validationGroups);
    }

    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'form.customer.email',
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event): void {
                $data = $event->getData();

                if (!isset($data['email'])) {
                    return;
                }

                $emailCanonical = $this->canonicalizer->canonicalize($data['email']);

                /** @var CustomerInterface|null $customer */
                $customer = $this->customerRepository->findOneBy(['emailCanonical' => $emailCanonical]);

                // assign existing customer or create a new one
                $form = $event->getForm();
                if (null !== $customer && null === $customer->getUser()) {
                    $form->setData($customer);

                    return;
                }

                /** @var CustomerInterface $customer */
                $customer = $this->customerFactory->createNew();
                $customer->setEmail($data['email']);

                $form->setData($customer);
            })
            ->setDataLocked(false)
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'customer_guest';
    }
}
