<?php

namespace App\EventListener\Vendor;

use App\Event\VendorEvent;
use App\Interface\CustomerInterface;
use App\Interface\GeneratorInterface;
use App\Provider\FlashBagProvider;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Webmozart\Assert\Assert;

// TODO: нужно поработать над єтим классом

final class VendorEmailUpdaterListener
{
    public function __construct(
        private readonly GeneratorInterface $tokenGenerator,
        private readonly ChannelContextInterface $channelContext,
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly RequestStack|SessionInterface $requestStackOrSession,
        private readonly TokenStorageInterface $tokenStorage,
    ) {
    }

    public function eraseVerification(GenericEvent $event): void
    {

        $customer = $event->getSubject();

        /* @var CustomerInterface $customer */
        Assert::isInstanceOf($customer, CustomerInterface::class);

        /** @var UserInterface|null $user */
        $user = $customer->getUser();
        Assert::isInstanceOf($user, UserInterface::class);
        Assert::methodExists($user, 'getUsername');

        if ($customer->getEmail() !== $user->getUsername()) {
            $user->setVerifiedAt(null);

            /** @var ChannelInterface $channel */
            $channel = $this->channelContext->getChannel();

            if ($channel->isAccountVerificationRequired()) {
                $token = $this->tokenGenerator->generate();
                $user->setEmailVerificationToken($token);

                $user->setEnabled(false);

                $this->tokenStorage->setToken(null);
            }
        }
    }

    public function sendVerificationEmail(GenericEvent $event): void
    {

        $customer = $event->getSubject();

        /* @var CustomerInterface $customer */
        Assert::isInstanceOf($customer, CustomerInterface::class);

        /** @var UserInterface $user */
        $user = $customer->getUser();
        Assert::isInstanceOf($user, UserInterface::class);

        /** @var UserInterface $channel */
        $channel = $this->channelContext->getChannel();

        if (!$channel->isAccountVerificationRequired()) {
            return;
        }

        if (!$user->isEnabled() && !$user->isVerified() && null !== $user->getEmailVerificationToken()) {
            $this->eventDispatcher->dispatch(new GenericEvent($user), VendorEvent::VENDOR_REQUEST_VERIFICATION_TOKEN);

            $flashBag = FlashBagProvider::getFlashBag($this->requestStackOrSession);
            $flashBag->add('success', 'vendor.verify_email_request');
        }
    }
}
