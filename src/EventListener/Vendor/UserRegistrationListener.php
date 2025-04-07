<?php

namespace App\EventListener\Vendor;

use App\EntityInterface\Channel\ChannelContextInterface;
use App\EntityInterface\Customer\CustomerInterface;
use Symfony\Component\Notifier\Channel\ChannelInterface;
use Webmozart\Assert\Assert;
use Doctrine\Persistence\ObjectManager;
use App\Interface\SecurityGeneratorInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class UserRegistrationListener
{
    public function __construct(
        private readonly ObjectManager $userManager,
        private readonly SecurityGeneratorInterface $tokenGenerator,
        private readonly EventDispatcherInterface $eventDispatcher,
        private readonly ChannelContextInterface $channelContext,
        private readonly UserLoginInterface $userLogin,
        private readonly string $firewallContextName,
    ) {
    }

    public function handleUserVerification(GenericEvent $event): void
    {
        $customer = $event->getSubject();
        Assert::isInstanceOf($customer, CustomerInterface::class);

        $user = $customer->getUser();
        Assert::notNull($user);

        /** @var ChannelInterface $channel */
        $channel = $this->channelContext->getChannel();
        if (!$channel->isAccountVerificationRequired()) {
            $this->enableAndLogin($user);

            return;
        }

        $this->sendVerificationEmail($user);
    }

    private function sendVerificationEmail(ShopUserInterface $user): void
    {
        $token = $this->tokenGenerator->generate();
        $user->setEmailVerificationToken($token);

        $this->userManager->persist($user);
        $this->userManager->flush();

        //        $this->eventDispatcher->dispatch(new GenericEvent($user), UserEvents::REQUEST_VERIFICATION_TOKEN);
    }

    private function enableAndLogin(ShopUserInterface $user): void
    {
        $user->setEnabled(true);

        $this->userManager->persist($user);
        $this->userManager->flush();

        $this->userLogin->login($user, $this->firewallContextName);
    }
}
