<?php

namespace App\Security;

use App\Entity\Vendor\VendorSecurity;
use Doctrine\ORM\EntityManagerInterface;

use JetBrains\PhpStorm\ArrayShape;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;


use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\UserPassportInterface;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractAuthenticator implements AuthenticationEntryPointInterface
{
    use TargetPathTrait;

    private EntityManagerInterface $entityManager;
    private UrlGeneratorInterface $urlGenerator;
    private CsrfTokenManagerInterface $csrfTokenManager;
    private UserPasswordHasherInterface $passwordHasher;

    private Request $request;
    private string $token;
    private string $pathToLogin;
    private string $pathToLoginSuccess;
    private LoggerInterface $logger;
    private FlashBagInterface $flashBag;

    public function __construct(EntityManagerInterface $entityManager,
                                UrlGeneratorInterface $urlGenerator,
                                CsrfTokenManagerInterface $csrfTokenManager,
                                UserPasswordHasherInterface $passwordHasher,
                                LoggerInterface $logger,
                                FlashBagInterface $flashBag,

                                string $token = 'No $token?! Must be initialized to parameters.yaml or service.yaml and service.bind:$token',
                                string $pathToLogin = 'No $token! Must be initialized to parameters.yaml or service.yaml and service.bind:$pathToLogin',
                                string $pathToLoginSuccess = 'No $pathToLoginSuccess! Must be initialized to parameters.yaml or service.yaml and service.bind:$pathToLoginSuccess',
                                )
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordHasher = $passwordHasher;
        $this->token = $token;
        $this->pathToLogin = $pathToLogin;
        $this->pathToLoginSuccess = $pathToLoginSuccess;
        $this->logger = $logger;
        $this->flashBag = $flashBag;
    }

    public function supports(Request $request): ?bool
    {
        return ($this->pathToLogin === $request->attributes->get('_route')) && $request->isMethod('POST');
    }

    #[ArrayShape(['email' => "mixed", 'password' => "mixed", 'csrf_token' => "mixed"])]
    public function getCredentials(Request $request): array
    {
        $credentials = [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];

            $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['email']
        );
        return $credentials;
    }

    public function getUser($credentials, UserPassportInterface $userProvider): object
    {
        $token = $this->token;

        $token = new CsrfToken($token, $credentials['_csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }

        $user = $this->entityManager->getRepository(VendorSecurity::class)->findOneBy(['email' => $credentials['email']]);

        if (!$user) {
            throw new CustomUserMessageAuthenticationException('Email|User could not be found.');
        }
        return $user;
    }

    public function checkCredentials($credentials, PasswordAuthenticatedUserInterface $passwordAuthenticatedUser): bool
    {
        return $this->passwordHasher->isPasswordValid($passwordAuthenticatedUser, $credentials['password']);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $firewallName): ?Response
    {
        $pathToLoginSuccess = $this->pathToLoginSuccess;
        $user = $token->getUser();
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }
        return new RedirectResponse($this->urlGenerator->generate($pathToLoginSuccess));
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
//        $user = $exception->getToken()->getUser();
        $user = $exception->getToken();
//        $user = 'SomeUser';
        $this->logger->notice('Failed to login user:" '. $user .' " ' . 'Reason: '. $exception->getMessage());
        $this->flashBag->add('error', 'Попытка неуспешная Вовсе!');

        return new RedirectResponse($this->urlGenerator->generate($this->pathToLogin));
    }

    public function authenticate(Request $request): PassportInterface
    {
        return new Passport(
            new UserBadge($request->request->get('email')),
            new PasswordCredentials($request->request->get('password')),
            [new CsrfTokenBadge($this->token, $request->request->get('_csrf_token'))]
        );
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        throw new CustomUserMessageAuthenticationException('Email|User could BE found!');
        // TODO: Implement start() method.
    }
}
