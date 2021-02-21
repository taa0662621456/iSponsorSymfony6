<?php

	namespace App\Security;

	use App\Entity\Vendor\VendorsSecurity;
	use Doctrine\ORM\EntityManagerInterface;

    use Symfony\Component\HttpFoundation\RedirectResponse;
	use Symfony\Component\HttpFoundation\Request;

    use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
    use Symfony\Component\Routing\RouterInterface;
	use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
	use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

    use Symfony\Component\Security\Core\Exception\BadCredentialsException;
    use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
	use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
	use Symfony\Component\Security\Core\Security;
	use Symfony\Component\Security\Core\User\UserInterface;
	use Symfony\Component\Security\Core\User\UserProviderInterface;
	use Symfony\Component\Security\Csrf\CsrfToken;
	use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
	use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

    use Symfony\Component\Security\Http\Util\TargetPathTrait;

    class LoginAuthenticator
		extends AbstractFormLoginAuthenticator
	{
		use TargetPathTrait;

        public const LOGIN_ROUTE = 'login';
        public const HOMEPAGE = 'homepage';

		private $entityManager;
		private $router;
		private $csrfTokenManager;
		private $passwordEncoder;
        /**
         * @var FlashBagInterface
         */
        private $flashBag;
        /**
         * @var Security
         */
        private $security;

        /**
         * LoginAuthenticator constructor.
         * @param EntityManagerInterface $entityManager
         * @param RouterInterface $router
         * @param CsrfTokenManagerInterface $csrfTokenManager
         * @param UserPasswordEncoderInterface $passwordEncoder
         * @param FlashBagInterface $flashBag
         * @param Security $security
         */
        public function __construct(EntityManagerInterface $entityManager, RouterInterface $router,
                                    CsrfTokenManagerInterface $csrfTokenManager,
                                    UserPasswordEncoderInterface $passwordEncoder,
                                    FlashBagInterface $flashBag,
                                    Security $security)
		{
			$this->entityManager = $entityManager;
			$this->router = $router;
			$this->csrfTokenManager = $csrfTokenManager;
			$this->passwordEncoder = $passwordEncoder;
			$this->flashBag = $flashBag;
            $this->security = $security;
        }

		public function supports(Request $request)
		{
		    if ($this->security->getUser()){
		        return false;
            }

		    return self::LOGIN_ROUTE === $request->attributes->get('_route')
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
				['email' => $credentials['email']] //TODO: можно установить вместо явного выражения '%app_property%'
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

        /**
         * Used to upgrade (rehash) the user's password automatically over time.
         * @param $credentials
         * @return string|null
         */
        public function getPassword($credentials): ?string
        {
            return $credentials['password'];
        }

		public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
		{
			if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
				return new RedirectResponse($targetPath);
			}

			// For example : return new RedirectResponse($this->router->generate('some_route'));
			//throw new Exception('TODO: provide a valid redirect inside '.__FILE__);

			// redirect to some "app_homepage" route - of wherever you want
			return new RedirectResponse($this->router->generate(self::HOMEPAGE));
		}

		protected function getLoginUrl()
		{
			return $this->router->generate(self::LOGIN_ROUTE);
		}
	}
