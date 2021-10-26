<?php

namespace App\Controller\Vendor;

use App\Repository\Vendor\VendorSecurityRepository;
use Doctrine\ORM\NonUniqueResultException;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\LoginLink\LoginLinkHandlerInterface;
use Symfony\Component\Security\Http\LoginLink\LoginLinkNotification;

class VendorLinkAuthenticatorController extends AbstractController
{
    /**
     * @Route("/link_authenticator", name="link_authenticator")
     */
    public function linkAuthenticator()
    {
        throw new LogicException('This function code should never be reached');
    }

    /**
     * @Route("/link_authenticator_page", name="link_authenticator_page")
     * @throws NonUniqueResultException
     */
    public function linkAuthenticatorPage(NotifierInterface $notifier, LoginLinkHandlerInterface $loginLinkHandler, VendorSecurityRepository $vendorsSecurityRepository, Request $request): Response
    {
        // Helper https://symfony.com.ua/doc/current/security/login_link.html
        // check if login form is submitted
        if ($request->isMethod('POST')) {



            // load the user in some way (e.g. using the form input)
            $email = $request->request->get('email');
            $user = $vendorsSecurityRepository->findOneBySomeField($email);

            // clone and customize Request
            $userRequest = clone $request;
            $userRequest->setLocale($user->getLocale() ?? $request->getDefaultLocale());

            // create a login link for $user this returns an instance
            // of LoginLinkDetails
            $loginLinkDetails = $loginLinkHandler->createLoginLink($user, $userRequest);
            $loginLink = $loginLinkDetails->getUrl();

            // create a notification based on the login link details
            $notification = new LoginLinkNotification(
                $loginLinkDetails,
                'Welcome to project!' . $loginLink
            );
            // create a recipient for this user
            $recipient = new Recipient($user->getEmail());

            // send the notification to the user
            $notifier->send($notification, $recipient);

            // render a "Login link is sent!" page
            return $this->render('security/linkAuthenticatorSent.html.twig');




            //TODO: email sending
            // ... send the link and return a response (see next section)
        }

        // if it's not submitted, render the "login" form
        return $this->render('security/linkAuthenticatorPage.html.twig');
    }

}
