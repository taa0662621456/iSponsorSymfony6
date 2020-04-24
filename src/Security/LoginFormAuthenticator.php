<?php

	namespace App\Security;

	use App\Entity\Vendor\VendorsSecurity;
	use Doctrine\ORM\EntityManagerInterface;
	use Exception;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\RedirectResponse;
	use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
    use Symfony\Component\Routing\RouterInterface;
	use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
	use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
    use Symfony\Component\Security\Core\Exception\AuthenticationException;
    use Symfony\Component\Security\Core\Exception\BadCredentialsException;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
	use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
	use Symfony\Component\Security\Core\Security;
	use Symfony\Component\Security\Core\User\UserInterface;
	use Symfony\Component\Security\Core\User\UserProviderInterface;
	use Symfony\Component\Security\Csrf\CsrfToken;
	use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
	use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
    use Symfony\Component\Security\Guard\AuthenticatorInterface;
    use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
    use Symfony\Component\Security\Http\Util\TargetPathTrait;
    use function Sodium\add;

    class LoginFormAuthenticator
		extends AbstractFormLoginAuthenticator
	{
		use TargetPathTrait;

		private $entityManager;
		private $router;
		private $csrfTokenManager;
		private $passwordEncoder;
        /**
         * @var FlashBagInterface
         */
        private $flashBag;
        public function __construct(EntityManagerInterface $entityManager, RouterInterface $router,
									CsrfTokenManagerInterface $csrfTokenManager,
									UserPasswordEncoderInterface $passwordEncoder,
                                    FlashBagInterface $flashBag)
		{
			$this->entityManager = $entityManager;
			$this->router = $router;
			$this->csrfTokenManager = $csrfTokenManager;
			$this->passwordEncoder = $passwordEncoder;
			$this->flashBag = $flashBag;
		}

		public function supports(Request $request)
		{
			return 'login' === $request->attributes->get('_route')
				&& $request->isMethod('POST');
		}

		public function getCredentials(Request $request)
		{
			$credentials = [
				'email'      => $request->request->get('email'),
				'password'   => $request->request->get('password'),
				'csrf_token' => $request->request->get('_csrf_token'),
			];

            $request->getSession()->set(
                Security::LAST_USERNAME,
                $credentials['email']
            );

			return $credentials;
		}

		public function getUser($credentials, UserProviderInterface $user)
		{
			$token = new CsrfToken('authenticate', $credentials['csrf_token']);
            if (!$this->csrfTokenManager->isTokenValid($token)) {
                throw new InvalidCsrfTokenException();
			}
			$user = $this->entityManager->getRepository(VendorsSecurity::class)->findOneBy(
				['email' => $credentials['email']]
			);

			if (!$user) {
                // fail authentication with a custom error
				throw new CustomUserMessageAuthenticationException('Email could not be found.');
			}

			return $user;
		}

		public function checkCredentials($credentials, UserInterface $user)
		{
            if (!$this->passwordEncoder->isPasswordValid($user, $credentials['password'])) {
                throw new BadCredentialsException('Login or User data not valid.');
            }
                return true;
                //return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
		}

		public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
		{
			if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
				return new RedirectResponse($targetPath);
			}

			// For example : return new RedirectResponse($this->router->generate('some_route'));
			//throw new Exception('TODO: provide a valid redirect inside '.__FILE__);

			// redirect to some "app_homepage" route - of wherever you want
			return new RedirectResponse($this->router->generate('homepage'));
		}


        /*public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
        {
            $data = array(
                'status' => 'error',
                'message' => 'Authentication Required'
            );
            $this->flashBag->add('error', 'sdfsdfsdfsdfsdf');

            return new Response('', 301, '');
        }*/

		protected function getLoginUrl()
		{

			return $this->router->generate('login');
		}
	}