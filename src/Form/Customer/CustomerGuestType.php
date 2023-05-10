<?php

namespace App\Form\Customer;

use App\Interface\CustomerInterface;
use App\Interface\Fixture\FixtureFactoryInterface;
use Composer\Repository\RepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CustomerGuestType extends AbstractType
{
//    protected string $dataClass;
//
//    /** @var string[] */
//    protected array $validationGroups = [];
//
//    /**
//     * @param string   $dataClass        FQCN
//     * @param string[] $validationGroups
//     */
//    public function __construct(
//        private readonly RepositoryInterface $customerRepository,
//        private readonly FactoryInterface $customerFactory,
//        private readonly CanonicalizerInterface $canonicalizer,
//        string $dataClass = 'data_class',
//        array $validationGroups = [],
//    ) {
//        $this->dataClass = $dataClass;
//        $this->validationGroups = $validationGroups;
//    }
//
//    public function buildForm(FormBuilderInterface $builder, array $options = []): void
//    {
//        $builder
//            ->add('email', EmailType::class, [
//                'label' => 'form.customer.email',
//            ])
//            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event): void {
//                $data = $event->getData();
//
//                if (!isset($data['email'])) {
//                    return;
//                }
//
//                $emailCanonical = $this->canonicalizer->canonicalize($data['email']);
//
//                /** @var CustomerInterface|null $customer */
//                $customer = $this->customerRepository->findOneBy(['emailCanonical' => $emailCanonical]);
//
//                // assign existing customer or create a new one
//                $form = $event->getForm();
//                if (null !== $customer && null === $customer->getUser()) {
//                    $form->setData($customer);
//
//                    return;
//                }
//
//                /** @var CustomerInterface $customer */
//                $customer = $this->customerFactory->createNew();
//                $customer->setEmail($data['email']);
//
//                $form->setData($customer);
//            })
//            ->setDataLocked(false)
//        ;
//    }
//
//    public function getBlockPrefix(): string
//    {
//        return 'customer_guest';
//    }
//
//    public function configureOptions(OptionsResolver $resolver): void
//    {
//        $resolver->setDefaults([
//            'data_class' => $this->dataClass,
//            'validation_groups' => $this->validationGroups,
//        ]);
//    }
}
