<?php

namespace App\User;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;
use Webmozart\Assert\Assert;

final class UserDeleteListener
{
    public function __construct(private readonly TokenStorageInterface $tokenStorage, private readonly SessionInterface|RequestStack $requestStackOrSession)
    {
        if ($requestStackOrSession instanceof SessionInterface) {
            trigger_deprecation('sylius/user-bundle', '1.12', sprintf('Passing an instance of %s as constructor argument for %s is deprecated as of Sylius 1.12 and will be removed in 2.0. Pass an instance of %s instead.', SessionInterface::class, self::class, RequestStack::class));
        }
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function deleteUser(ResourceControllerEvent $event): void
    {
        $user = $event->getSubject();

        Assert::isInstanceOf($user, UserInterface::class);

        if ($this->isTryingToDeleteLoggedInUser($user)) {
            $event->stopPropagation();
            $event->setErrorCode(Response::HTTP_UNPROCESSABLE_ENTITY);
            $event->setMessage('Cannot remove currently logged in user.');

            if ($this->requestStackOrSession instanceof SessionInterface) {
                $session = $this->requestStackOrSession;
            } else {
                $session = $this->requestStackOrSession->getSession();
            }

            /** @var FlashBagInterface $flashBag */
            $flashBag = $session->getBag('flashes');
            $flashBag->add('error', 'Cannot remove currently logged in user.');
        }
    }

    private function isTryingToDeleteLoggedInUser(UserInterface $user): bool
    {
        Assert::isInstanceOf($user, ResourceInterface::class);
        Assert::isInstanceOf($user, SymfonyUserInterface::class);
        $token = $this->tokenStorage->getToken();
        if (!$token) {
            return false;
        }

        $loggedUser = $token->getUser();
        if ($loggedUser === null) {
            return false;
        }
        Assert::isInstanceOf($loggedUser, ResourceInterface::class);

        return $loggedUser->getId() === $user->getId() && $loggedUser->getRoles() === $user->getRoles();
    }
}
