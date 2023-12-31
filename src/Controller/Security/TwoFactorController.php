<?php

namespace App\Controller\Security;

use JetBrains\PhpStorm\NoReturn;
use App\Controller\BaseController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Totp\TotpAuthenticatorInterface;

class TwoFactorController extends BaseController
{
    #[NoReturn] #[Route(path: '/2fa/enable', name: '2fa_enable', methods: 'GET')]
    #[IsGranted('ROLE_USER', message: 'Page not found. No access! Get out!', statusCode: 404)]
    public function enable2fa(TotpAuthenticatorInterface $totpAuthenticator, EntityManagerInterface $entityManager): void
    {
        $user = $this->getUser();
        if (!$user->isTotpAuthenticationEnabled()) {
            $user->setTotpSecret($totpAuthenticator->generateSecret());
            $entityManager->flush();
        }
        dd($user);
    }
}
