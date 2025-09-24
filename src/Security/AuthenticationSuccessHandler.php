<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Webmozart\Assert\Assert;

final class AuthenticationSuccessHandler extends DefaultAuthenticationSuccessHandler
{
    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        if ($request->isXmlHttpRequest()) {
            $user = $token->getUser();
            Assert::notNull($user);
            Assert::methodExists($user, 'getUsername');

            return new JsonResponse(['success' => true, 'username' => $user->getUsername()]);
        }

        return parent::onAuthenticationSuccess($request, $token);
    }
}