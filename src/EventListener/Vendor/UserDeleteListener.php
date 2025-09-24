<?php

namespace App\EventListener\Vendor;

use InvalidArgumentException;
use Webmozart\Assert\Assert;
use App\Event\Controller\ControllerEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

// TODO: ???
class UserDeleteListener
{
    public function __construct(
        private readonly TokenStorageInterface $tokenStorage,
        private readonly SessionInterface|RequestStack $requestStackOrSession
    ) {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function deleteUser(ControllerEvent $event): void
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
        Assert::isInstanceOf($user, SymfonyUserInterface::class);
        $token = $this->tokenStorage->getToken();
        if (!$token) {
            return false;
        }

        $loggedUser = $token->getUser();
        if (null === $loggedUser) {
            return false;
        }

        return $loggedUser->getId() === $user->getId() && $loggedUser->getRoles() === $user->getRoles();
    }
}