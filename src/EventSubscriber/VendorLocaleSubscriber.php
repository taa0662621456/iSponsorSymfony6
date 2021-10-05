<?php


namespace App\EventSubscriber;


use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class VendorLocaleSubscriber implements EventSubscriberInterface
{
    private SessionInterface $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @param InteractiveLoginEvent $event
     */
    public function onInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();

        if (null !== $user->getLocale()) {
            $this->session->set('_locale', $user->getLocale());
        }
    }

    #[ArrayShape(['response' => "string"])] public static function getSubscribedEvents(): array
    {
        // TODO: Implement getSubscribedEvents() method.
        //return ['response' => 'onInteractiveLogin'];
        return array('response' => array('onInteractiveLogin', -255));
    }
}