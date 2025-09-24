<?php

namespace App\EventListener;

use Doctrine\Persistence\ObjectManager;
use Webmozart\Assert\Assert;

final class UpdateUserEncoderListener
{
    public function __construct(
        private ObjectManager $objectManager,
        private string $recommendedEncoderName,
        private string $className,
        private string $interfaceName,
        private string $passwordParameter,
    ) {
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event): void
    {
        $user = $event->getAuthenticationToken()->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        if (!$user instanceof $this->className || !$user instanceof $this->interfaceName) {
            return;
        }

        Assert::methodExists($user, 'getEncoderName');
        if ($user->getEncoderName() === $this->recommendedEncoderName) {
            return;
        }

        $request = $event->getRequest();

        $plainPassword = $request->request->get($this->passwordParameter);
        if (null === $plainPassword || '' === $plainPassword) {
            return;
        }

        $user->setEncoderName($this->recommendedEncoderName);
        $user->setPlainPassword((string) $plainPassword);

        $this->objectManager->persist($user);
        $this->objectManager->flush();
    }
}