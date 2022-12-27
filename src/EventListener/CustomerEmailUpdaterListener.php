<?php

namespace App\EventListener;

use App\Provider\FlashBagProvider;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Webmozart\Assert\Assert;

final class CustomerEmailUpdaterListener
{
    public function __construct(
        private readonly GeneratorInterface            $tokenGenerator,
        private readonly ChannelContextInterface       $channelContext,
        private readonly EventDispatcherInterface      $eventDispatcher,
        private readonly RequestStack|SessionInterface $requestStackOrSession,
        private readonly SectionProviderInterface      $uriBasedSectionContext,
        private readonly TokenStorageInterface         $tokenStorage,
    ) {
        if ($requestStackOrSession instanceof SessionInterface) {
            trigger_deprecation('sylius/shop-bundle', '1.12', sprintf('Passing an instance of %s as constructor argument for %s is deprecated as of Sylius 1.12 and will be removed in 2.0. Pass an instance of %s instead.', SessionInterface::class, self::class, RequestStack::class));
        }
    }

    public function eraseVerification(GenericEvent $event): void
    {
        if (!$this->uriBasedSectionContext->getSection() instanceof ShopSection) {
            return;
        }

        $customer = $event->getSubject();

        /** @var CustomerInterface $customer */
        Assert::isInstanceOf($customer, CustomerInterface::class);

        /** @var ShopUserInterface|null $user */
        $user = $customer->getUser();
        Assert::isInstanceOf($user, ShopUserInterface::class);
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
        if (!$this->uriBasedSectionContext->getSection() instanceof ShopSection) {
            return;
        }

        $customer = $event->getSubject();

        /** @var CustomerInterface $customer */
        Assert::isInstanceOf($customer, CustomerInterface::class);

        /** @var ShopUserInterface $user */
        $user = $customer->getUser();
        Assert::isInstanceOf($user, ShopUserInterface::class);

        /** @var ChannelInterface $channel */
        $channel = $this->channelContext->getChannel();

        if (!$channel->isAccountVerificationRequired()) {
            return;
        }

        if (!$user->isEnabled() && !$user->isVerified() && null !== $user->getEmailVerificationToken()) {
            $this->eventDispatcher->dispatch(new GenericEvent($user), UserEvents::REQUEST_VERIFICATION_TOKEN);

            $flashBag = FlashBagProvider::getFlashBag($this->requestStackOrSession);
            $flashBag->add('success', 'sylius.user.verify_email_request');
        }
    }
}
