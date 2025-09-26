<?php

namespace App\Controller\Security;

use App\Controller\BaseController;
use App\Entity\Vendor\VendorSecurity;
use App\Service\Security\SecurityTwoFactorManager;
use Doctrine\ORM\EntityManagerInterface;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Writer\PngWriter;
use Psr\Log\LoggerInterface;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Totp\TotpAuthenticatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/auth/2fa', name: 'auth_2fa_')]
class TwoFactorController extends BaseController
{
    public function __construct(
        private readonly SecurityTwoFactorManager $twoFactor,
        private readonly LoggerInterface $logger,
    ) {}

    #[Route('', name: 'form', methods: ['GET','POST'])]
    public function verify(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            if (!$this->isCsrfTokenValid('2fa', $request->request->get('_token'))) {
                throw $this->createAccessDeniedException('CSRF token invalid');
            }

            /** @var VendorSecurity $user */
            $user = $this->getUser();
            $code = (string) $request->request->get('code');

            if ($this->twoFactor->validateTotp($user, $code)) {
                $this->logger->info('2FA success', ['user' => $user->getUserIdentifier()]);
                return $this->redirectToRoute('dashboard');
            }

            $this->logger->warning('2FA failed', ['user' => $user->getUserIdentifier()]);
            $this->addFlash('danger', 'Неверный код');
        }

        $response = new Response();
        $response->headers->set('Cache-Control', 'no-store, max-age=0');
        return $this->render('security/2fa.html.twig', [
            'csrf_token_id' => '2fa'
        ], $response);
    }

    #[Route(path: '/enable', name: 'enable', methods: ['GET'])]
    #[IsGranted('ROLE_USER', message: 'Page not found. No access!', statusCode: 404)]
    public function enable2fa(
        TotpAuthenticatorInterface $totpAuthenticator,
        EntityManagerInterface $entityManager
    ): Response {
        /** @var VendorSecurity $user */
        $user = $this->getUser();

        if (!$user->isTotpAuthenticationEnabled()) {
            $secret = $totpAuthenticator->generateSecret();
            $user->setTotpSecret($secret);
            $entityManager->flush();
            $this->logger->info('2FA enabled', ['user' => $user->getUserIdentifier()]);
        } else {
            $secret = $user->getTotpSecret();
        }

        // Формируем otpauth:// URI (стандарт для Google Authenticator)
        $issuer = $this->getParameter('app_name');
        $otpauth = sprintf(
            'otpauth://totp/%s:%s?secret=%s&issuer=%s&algorithm=SHA1&digits=6&period=30',
            $issuer,
            $user->getEmail(),
            $secret,
            $issuer
        );

        // Генерация QR-кода
        $qrResult = Builder::create()
            ->writer(new PngWriter())
            ->data($otpauth)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->labelText('Scan to setup 2FA')
            ->labelFontSize(14)
            ->build();

        $qrDataUri = $qrResult->getDataUri();

        return $this->render('security/2fa_enable.html.twig', [
            'qr' => $qrDataUri,
            'secret' => $secret,
        ]);
    }
}
