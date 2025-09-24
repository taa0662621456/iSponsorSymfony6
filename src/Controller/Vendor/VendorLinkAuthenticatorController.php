<?php

namespace App\Controller\Vendor;

use App\Repository\Vendor\VendorCodeStorageRepository;
use App\Repository\Vendor\VendorSecurityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\LoginLink\LoginLinkHandlerInterface;
use Symfony\Component\Security\Http\LoginLink\LoginLinkNotification;

#[AsController]
#[Route('/auth/magic', name: 'auth_magic_')]
class VendorLinkAuthenticatorController extends AbstractController
{
    public function __construct(
        private readonly VendorCodeStorageRepository $repo,
        private readonly VendorSecurityRepository $vendorRepo,
        private readonly LoggerInterface $logger,
        private readonly RateLimiterFactory $magicLinkLimiter,
    ) {}

    #[Route('', name: 'link', methods: ['GET'])]
    public function magicLink(Request $request): Response
    {
        $limiter = $this->magicLinkLimiter->create($request->getClientIp() ?? 'anon');
        if (!$limiter->consume(1)->isAccepted()) {
            $this->logger->warning('Magic link rate-limited', ['ip' => $request->getClientIp()]);
            return $this->render('security/rate_limited.html.twig', parameters: 'status',response: 429);
        }

        $code = (string) $request->query->get('code');
        if ($code === '') {
            $this->addFlash('danger', 'Код не найден');
            return $this->redirectToRoute('auth_login');
        }

        $record = $this->repo->findOneBy(['code' => $code]);
        if (!$record || $record->isExpired()) {
            $this->addFlash('danger', 'Ссылка недействительна');
            return $this->redirectToRoute('auth_login');
        }

        try {
            $user = $record->getVendor();
            if (!$user->isEnabled() || !$user->isEmailConfirmed()) {
                $this->addFlash('danger', 'Аккаунт не активен');
                return $this->redirectToRoute('auth_login');
            }

            // Логиним пользователя вручную (например через Guard или Authenticator)
            // $this->authService->authenticateVendor($user);

            // Одноразовость
            $this->repo->remove($record, flush: true);

            // Безопасный redirect
            $target = $request->query->get('target', 'vendor_dashboard_index');
            $allowedTargets = ['vendor_dashboard_index', 'profile_index'];
            if (!in_array($target, $allowedTargets, true)) {
                $target = 'vendor_dashboard_index';
            }

            return $this->redirectToRoute($target);
        } catch (\Throwable $e) {
            $this->logger->error('Magic link failed', ['exception' => $e]);
            $this->addFlash('danger', 'Не удалось войти по ссылке');
            return $this->redirectToRoute('auth_login');
        }
    }

    /**
     * Альтернативный вариант через Symfony login-link
     * @throws NonUniqueResultException
     */
    #[Route('/send', name: 'send', methods: ['POST'])]
    public function sendMagicLink(
        Request $request,
        NotifierInterface $notifier,
        LoginLinkHandlerInterface $loginLinkHandler
    ): Response {
        $email = (string) $request->request->get('email');
        $user = $this->vendorRepo->findOneBy(['email' => $email]);

        if (!$user) {
            $this->addFlash('danger', 'Пользователь не найден');
            return $this->redirectToRoute('auth_login');
        }

        $loginLinkDetails = $loginLinkHandler->createLoginLink($user, $request);
        $notification = new LoginLinkNotification(
            $loginLinkDetails,
            'Ссылка для входа в личный кабинет'
        );
        $recipient = new Recipient($user->getEmail());

        $notifier->send($notification, $recipient);

        $this->addFlash('success', 'На вашу почту отправлена ссылка для входа');
        return $this->redirectToRoute('auth_login');
    }
}
