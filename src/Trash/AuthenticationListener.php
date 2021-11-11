<?php


namespace App\Listener;


use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AuthenticationListener
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var AuthenticationManagerInterface
     */
    private $authenticationManager;

    /**
     * @var string Uniquely identifies the secured area
     */
    private $providerKey;

    // ...

    public function __invoke(RequestEvent $event)
    {
//        $password = $event->getRequest()->;
        $password = $event->getRequest()->getPassword();
        $clientIp = $event->getRequest()->getClientIp();
        $user = $event->getRequest()->getUser();


        $unauthenticatedToken = new UsernamePasswordToken(
            $username,
            $password,
            $this->providerKey
        );

        $authenticatedToken = $this
            ->authenticationManager
            ->authenticate($unauthenticatedToken);

        $this->tokenStorage->setToken($authenticatedToken);
    }

}
