<?php

namespace App\EventListener;

use Doctrine\Persistence\ObjectManager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class UserRegistrationListener
{
    public function __construct(
        private ObjectManager $userManager,
        private GeneratorInterface $tokenGenerator,
        private EventDispatcherInterface $eventDispatcher,
        private ChannelContextInterface $channelContext,
        private UserLoginInterface $userLogin,
        private string $firewallContextName,
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

        $this->eventDispatcher->dispatch(new GenericEvent($user), UserEvents::REQUEST_VERIFICATION_TOKEN);
    }

    private function enableAndLogin(ShopUserInterface $user): void
    {
        $user->setEnabled(true);

        $this->userManager->persist($user);
        $this->userManager->flush();

        $this->userLogin->login($user, $this->firewallContextName);
    }
}
