<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LinkAuthSuccessHandlerAuthenticator implements AuthenticationSuccessHandlerInterface
{

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return JsonResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token): JsonResponse
    {
        // TODO: Implement onAuthenticationSuccess() method.
        $user = $token->getUser();
        $userApiToken = $user->getApiToken(); //TODO: getApiToken

        return new JsonResponse(['apiToken' => 'userApiToken']);
    }
}