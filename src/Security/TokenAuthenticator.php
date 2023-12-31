<?php
namespace App\Security;

use App\Entity\Vendor\VendorSecurity;
use App\Repository\Vendor\VendorSecurityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class TokenAuthenticator extends AbstractAuthenticator
{
        public function __construct(private readonly VendorSecurityRepository $VendorSecurityRepository)
		{
		}

        /**
         *
         * @param Request $request
         *
         * @return bool|null
         */
		public function supports(Request $request): ?bool
		{
			return $request->headers->has('X-AUTH-TOKEN');
		}

    public function authenticate(Request $request): Passport
    {
        $apiToken = $request->headers->get('X-AUTH-TOKEN');
        if (null === $apiToken) {
            throw new CustomUserMessageAuthenticationException('No API token provided');
        }

        return new Passport(
            new UserBadge($apiToken, function ($apiToken) {
                return $this->VendorSecurityRepository->findOneByApiToken($apiToken);
            }),
            new CustomCredentials(
                function ($credentials, VendorSecurity $vendorSecurity) {

                    return $vendorSecurity->getApiToken() === $credentials;
                },
                $apiToken
            )
        );
    }




    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $firewallName): ?Response
    {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $data = [
            'message' => 'Authentication Failed',
            'error' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ];


        return new JsonResponse ($data, Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication is needed, but it's not sent
     *
     * @param Request                      $request
     * @param AuthenticationException|null $authException
     *
     * @return JsonResponse
     */
    public function start(Request $request, AuthenticationException $authException = null): JsonResponse
    {
        $data = [
            'message' => 'Authentication Required - No API token provided'
        ];


        return new JsonResponse ($data, Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe(): bool
    {
        return false;
    }
}
