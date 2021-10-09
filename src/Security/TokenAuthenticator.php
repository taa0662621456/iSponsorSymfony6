<?php
	/**
	 * https://symfony.com/doc/current/security/guard_authentication.html is deprecated
	 */

	namespace App\Security;

	use App\Entity\Vendor\VendorsSecurity;
    use App\Repository\Vendor\VendorsRepository;
    use App\Repository\Vendor\VendorsSecurityRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\JsonResponse;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
	use Symfony\Component\Security\Core\Exception\AuthenticationException;
	use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Component\Security\Core\User\UserProviderInterface;
    use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
    use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
    use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
    use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
    use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

    class TokenAuthenticator extends AbstractAuthenticator
	{
		private EntityManagerInterface $em;

        private VendorsSecurityRepository $vendorsSecurityRepository;

        public function __construct(EntityManagerInterface $em,
                                    VendorsSecurityRepository $vendorsSecurityRepository)
		{
			$this->em = $em;
			$this->vendorsSecurityRepository = $vendorsSecurityRepository;
		}

        /**
         * Called on every request to decide if this authenticator should be
         * used for the request. Returning false will cause this authenticator
         * to be skipped.
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
                // The token header was empty, authentication fails with HTTP Status
                // Code 401 "Unauthorized"
                throw new CustomUserMessageAuthenticationException('No API token provided');
            }
            return new Passport(
                new UserBadge($apiToken, function ($userId) {
                    return $this->vendorsSecurityRepository->findBy([], ['Id' => $userId], 1, null);
                    //return $this->vendorRepository->loadUserByApiToken($userIdentifier);
                }),
                new CustomCredentials(
                    function ($credentials, UserInterface $user) {
                        return $user->getApiToken() === $credentials;
                    },
                    $apiToken
                ));
            //return new SelfValidatingPassport(new UserBadge($apiToken));
        }


		public function getUser($credentials, UserProviderInterface $userProvider)
		{
			$apiToken = $credentials ['token'];

			if (null === $apiToken) {
				return null;
			}

			// if a User object, checkCredentials() is called
			return $this->em->getRepository(VendorsSecurity :: class)
				->findOneBy(['apiKey' => $apiToken]);
		}

		public function onAuthenticationSuccess(Request $request, TokenInterface $token, $firewallName): ?Response
		{
			// on success, let the request continue
			return null;
		}

		public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
		{
			$data = [
				'message' => strtr($exception->getMessageKey(), $exception->getMessageData())

				// or to translate this message
				// $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
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
				// you might translate this message
				'message' => 'Authentication Required'
			];

			return new JsonResponse ($data, Response::HTTP_UNAUTHORIZED);
		}

		public function supportsRememberMe(): bool
        {
			return false;
		}
	}
