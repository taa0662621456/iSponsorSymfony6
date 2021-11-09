<?php

namespace App\Security;

use App\Entity\Vendor\VendorSecurity;
use App\Repository\Vendor\VendorRepository;
use App\Repository\Vendor\VendorSecurityRepository;
use Doctrine\ORM\EntityManagerInterface;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;


use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractAuthenticator
{
//    use TargetPathTrait;

    public const LOGIN_ROUTE = 'login';
    public const HOMEPAGE = 'homepage';

    private EntityManagerInterface $entityManager;
    private RouterInterface $router;
    private CsrfTokenManagerInterface $csrfTokenManager;
    private UserPasswordHasherInterface $passwordEncoder;
    private FlashBagInterface $flashBag;
    private Security $security;
    private UrlGeneratorInterface $urlGenerator;
    private VendorRepository $vendorRepository;
    private VendorSecurityRepository $vendorSecurityRepository;

    /**
     * LoginAuthenticator constructor.
     * @param EntityManagerInterface $entityManager
     * @param VendorSecurityRepository $vendorSecurityRepository
     * @param RouterInterface $router
     * @param CsrfTokenManagerInterface $csrfTokenManager
     * @param UserPasswordHasherInterface $passwordHasher
     * @param FlashBagInterface $flashBag
     * @param Security $security
     */
    public function __construct(EntityManagerInterface      $entityManager,
                                VendorSecurityRepository    $vendorSecurityRepository,
                                RouterInterface             $router,
                                CsrfTokenManagerInterface   $csrfTokenManager,
                                UserPasswordHasherInterface $passwordHasher,
                                FlashBagInterface           $flashBag,
                                Security                    $security)
    {
        $this->entityManager = $entityManager;
        $this->vendorSecurityRepository = $vendorSecurityRepository;
        $this->router = $router;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordEncoder = $passwordHasher;
        $this->flashBag = $flashBag;
        $this->security = $security;
    }

    /**
     * @param Request $request
     * @return bool|null
     */
    public function supports(Request $request): ?bool
    {
        var_dump();
        return self::LOGIN_ROUTE === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

//    #[ArrayShape(['email' => "mixed", 'password' => "mixed", 'csrf_token' => "mixed"])]
//    public function getCredentials(Request $request): array
//    {
//        $credentials = [
//            'email'      => $request->request->get('email'),
//            'password'   => $request->request->get('password'),
//            'csrf_token' => $request->request->get('_csrf_token'),
//        ];
//        $request->getSession()->set(
//            Security::LAST_USERNAME,
//            $credentials['email']
//        );
//
//        return $credentials;
//    }

//    public function getUser(Request $request): object
//    {
//        $credentials = [
//            'email'      => $request->request->get('email'),
//            'password'   => $request->request->get('password'),
//            'csrf_token' => $request->request->get('_csrf_token'),
//        ];
//
//        $email = $credentials['email'];
//        $passport = new Passport(new UserBadge($email), $credentials);
//        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
//        if (!$this->csrfTokenManager->isTokenValid($token)) {
//            throw new InvalidCsrfTokenException();
//        }
//        $user = $this->entityManager->getRepository(VendorSecurity::class)->findOneBy(
//            ['email' => $credentials['email']] //TODO: можно установить вместо явного выражения '%app_property%'
//        );
//
//        if (!$user) {
//            // fail authentication with a custom error
//            throw new CustomUserMessageAuthenticationException('Email could not be found.');
//        }
//
//        return $user;
//    }

//    public function checkCredentials($credentials, UserInterface $user): UserInterface
//    {
//        if (!$this->passwordEncoder->isPasswordValid($user, $credentials['password'])) {
//            throw new BadCredentialsException('Login or User data not valid.');
//        }
//        return $user;
//    }

//    /**
//     * Used to upgrade (rehash) the user's password automatically over time.
//     * @param $credentials
//     * @return string|null
//     */
//    public function getPassword($credentials): ?string
//    {
//        return $credentials['password'];
//    }

    /**
     * @param Request $request
     * @return PassportInterface
     */
    public function authenticate(Request $request): PassportInterface
    {
        $password = $request->request->get('password');
        $username = $request->request->get('username');
        $csrfToken = $request->request->get('csrf_token');
        $email = $request->request->get('email');
        $rememberMe = '';

        // ... validate no parameter is empty
//        if (null === $email) {
//            throw new CustomUserMessageAuthenticationException('No username provided');
//        }
//        $request->getSession()->set(Security::LAST_USERNAME, $email);

        return new Passport(
            new UserBadge($email, function($userIdentifier){
                $user = $this->vendorSecurityRepository->findOneBy(['email' => $userIdentifier]);

                if (!$user) {
                    throw new UserNotFoundException('Толи нет юзера толи еще что');
                }
                return $user;
            }),
            new PasswordCredentials($password)
//            [new CsrfTokenBadge('login', $csrfToken)]
        );



// v2
//        return new Passport(
//            new UserBadge($email, function ($userIdentifier) {
//                return $this->vendorRepository->findOneBy(['email' => $userIdentifier]);
//            }), $credentials);

// v3        return new Passport(new UserBadge($email), new PasswordCredentials($plaintextPassword));
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $firewallName
     * @return Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
//        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
//            return new RedirectResponse($targetPath);
//        }

        // For example : return new RedirectResponse($this->router->generate('some_route'));
        //throw new Exception('TODO: provide a valid redirect inside '.__FILE__);

        // redirect to some "app_homepage" route - of wherever you want
        return new RedirectResponse($this->router->generate(self::HOMEPAGE));
    }
//    protected function getLoginUrl(Request $request): string
//    {
////        выполняется проверка на локаль
////        $locale = $request->getLocale();
////        if (str_starts_with($request->getPathInfo(), "/{$locale}/")) {
////            return $this->urlGenerator->generate(self::LOGIN_ROUTE_LOCALIZED);
////        }
//        return $this->router->generate(self::LOGIN_ROUTE);

//    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);
//        $data = [
//            // you may want to customize or obfuscate the message first
//            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
//
//            // or to translate this message
//            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
//        ];

        return new RedirectResponse(
            $this->router->generate('login')
        );
    }
}
