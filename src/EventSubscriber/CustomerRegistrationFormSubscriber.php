<?php

namespace App\EventSubscriber;

use App\Interface\CustomerInterface;
use App\Interface\Vendor\VendorRepositoryInterface;
use Composer\Repository\RepositoryInterface;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Webmozart\Assert\Assert;

final class CustomerRegistrationFormSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly VendorRepositoryInterface $vendorRepository)
    {
    }

    #[ArrayShape([FormEvents::PRE_SUBMIT => 'string'])]
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SUBMIT => 'preSubmit',
        ];
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function preSubmit(FormEvent $event): void
    {
        $rawData = $event->getData();
        $form = $event->getForm();
        $data = $form->getData();

        Assert::isInstanceOf($data, CustomerInterface::class);

        // if email is not filled in, go on
        if (empty($rawData['email'])) {
            return;
        }

        /** @var CustomerInterface|null $existingCustomer */
        $existingCustomer = $this->vendorRepository->findOneBy(['email' => $rawData['email']]);
        if (null === $existingCustomer || null !== $existingCustomer->getUser()) {
            return;
        }

        $existingCustomer->setUser($data->getUser());
        $form->setData($existingCustomer);
    }
}
