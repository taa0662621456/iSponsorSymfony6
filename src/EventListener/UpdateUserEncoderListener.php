<?php

namespace App\EventListener;

use Webmozart\Assert\Assert;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

final class UpdateUserEncoderListener
{
    public function __construct(
        private readonly ObjectManager $objectManager,
        private readonly string $recommendedEncoderName,
        private readonly string $className,
        private readonly string $interfaceName,
        private readonly string $passwordParameter,
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
