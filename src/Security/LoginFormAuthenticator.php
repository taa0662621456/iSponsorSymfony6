<?php
namespace App\Security;

use App\Entity\Vendor\VendorSecurity;
use App\Service\Security\SecurityPasswordMigrator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly UrlGeneratorInterface $urlGen,
        private readonly UserPasswordHasherInterface $hasher,
        private readonly SecurityPasswordMigrator $migrator
    ) {}

    public function authenticate(Request $request): Passport
    {
        $email = (string)$request->request->get('_email');
        $pass  = (string)$request->request->get('_password');

        return new Passport(
            new UserBadge($email, function (string $id) {
                $user = $this->em->getRepository(VendorSecurity::class)->findOneBy(['email' => $id]);
                if (!$user) throw new UserNotFoundException();
                return $user;
            }),
            new PasswordCredentials($pass),
            [
                new CsrfTokenBadge('authenticate', (string)$request->request->get('_csrf_token')),
                (new RememberMeBadge())->enable(),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, $token, string $firewallName)
    {
        $user = $token->getUser();
        $plain = (string)$request->request->get('_password');
        $this->migrator->upgradeHashIfNeeded($user, $plain);

        if ($path = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($path);
        }
        return new RedirectResponse($this->urlGen->generate('app_homepage'));
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGen->generate('auth_login');
    }
}