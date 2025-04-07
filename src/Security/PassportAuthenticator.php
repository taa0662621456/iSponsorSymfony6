<?php
/**
 * https://symfony.com/doc/current/security/guard_authentication.html is deprecated
 */

namespace App\Security;

use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class PassportAuthenticator extends AbstractAuthenticator
{

    #[NoReturn] public function supports(Request $request): ?bool
    {
        dd($request);
        // TODO: Implement supports() method.
        return true;
    }

    public function authenticate(Request $request): Passport
    {
        $password = $request->request->get('password');
        $username = $request->request->get('username');
        $csrfToken = $request->request->get('csrf_token');

        // ... validate no parameter is empty

        return new Passport(
            new UserBadge($username),
            new PasswordCredentials($password),
            [new CsrfTokenBadge('login', $csrfToken)]

        );
    }
        /**
         * @param Request $request
         * @param TokenInterface $token
         * @param string $firewallName
         * @return Response|null
         */
        public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
        {
            var_dump('Ok');
            // TODO: Implement onAuthenticationSuccess() method.
            return null;
        }

        /**
         * @param Request $request
         * @param AuthenticationException $exception
         * @return Response|null
         */
        public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
        {
            var_dump('No Ok');

            // TODO: Implement onAuthenticationFailure() method.
            return null;
        }


}
