<?php


namespace App\Form\Customer;


use App\Interface\CustomerInterface;
use App\Interface\Factory\FactoryInterface;
use Composer\Repository\RepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class CustomerCheckoutGuestType extends AbstractType
{
    protected string $dataClass;

    /** @var string[] */
    protected array $validationGroups = [];

    /**
     * @param string $dataClass FQCN
     * @param string[] $validationGroups
     */
    public function __construct(
        string                                  $dataClass,
        array                                   $validationGroups,
        private readonly RepositoryInterface    $customerRepository,
        private readonly FactoryInterface       $customerFactory,
        private readonly CanonicalizerInterface $canonicalizer,
    ) {
        $this->dataClass = $dataClass;
        $this->validationGroups = $validationGroups;
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
                if (null === $customer) {
                    /** @var CustomerInterface $customer */
                    $customer = $this->customerFactory->createNew();
                    $customer->setEmail($data['email']);
                }

                $form = $event->getForm();
                $form->setData($customer);
            })
            ->setDataLocked(false)
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'customer_checkout_guest';
    }
}
