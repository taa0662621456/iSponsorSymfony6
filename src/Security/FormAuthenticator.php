<?php

namespace App\Security;

use App\Entity\Vendor\VendorSecurity;
use Doctrine\ORM\EntityManagerInterface;

use JetBrains\PhpStorm\ArrayShape;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class FormAuthenticator extends AbstractAuthenticator implements AuthenticationEntryPointInterface
{
    use TargetPathTrait;

    private Request $request;

    public function __construct(private readonly EntityManagerInterface      $entityManager,
                                private readonly UrlGeneratorInterface       $urlGenerator,
                                private readonly CsrfTokenManagerInterface   $csrfTokenManager,
                                private readonly UserPasswordHasherInterface $passwordHasher,
                                private readonly LoggerInterface             $logger,

                                private readonly string                      $token = 'No $token?! Must be initialized to parameters.yaml or service.yaml and service.bind:$token',
                                private readonly string                      $pathToLogin = 'No $token! Must be initialized to parameters.yaml or service.yaml and service.bind:$pathToLogin',
                                private readonly string                      $pathToLoginSuccess = 'No $pathToLoginSuccess! Must be initialized to parameters.yaml or service.yaml and service.bind:$pathToLoginSuccess',
                                )
    {
    }

    public function supports(Request $request): bool
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

    public function getUser($credentials): object
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
//        $user = $exception->getToken()->getUser(;
        $user = $exception->getToken();
//        $user = 'SomeUser';
        $session = $request->getSession();
        $this->logger->notice('Failed to login user:" '. $user .' " ' . 'Reason: '. $exception->getMessage());
        $session->getFlashBag()->add('error', 'Попытка неуспешная Вовсе! Логин или пароль введені не верно');

        return new RedirectResponse($this->urlGenerator->generate($this->pathToLogin));
    }

    public function authenticate(Request $request): Passport
    {
        return new Passport(
            new UserBadge($request->request->get('email')),
            new PasswordCredentials($request->request->get('password')),
            [new CsrfTokenBadge($this->token, $request->request->get('_csrf_token'))]
        );
    }

    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        throw new CustomUserMessageAuthenticationException('Email|User could BE found!');
        // TODO: Implement start() method.
    }
}
