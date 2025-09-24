<?php

namespace App\Controller\Security;

use App\Repository\Vendor\VendorCodeStorageRepository;
use App\Service\SmsServiceInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('/auth/sms', name: 'auth_sms_')]
class SmsConfirmationController extends AbstractController
{
    public function __construct(
        private readonly VendorCodeStorageRepository $code,
        private readonly SmsServiceInterface         $sms,
        private readonly LoggerInterface             $logger,
        private readonly RateLimiterFactory          $smsLimiter
    ) {}

    #[Route('/send', name: 'send', methods: ['POST'])]
    public function send(Request $request): Response
    {
        $limiter = $this->smsLimiter->create($request->getClientIp() ?? 'anon');
        if (false === $limiter->consume(1)->isAccepted()) {
            return new Response('Too many requests', 429);
        }

        $phone = (string) $request->request->get('phone');
        $code = random_int(100000, 999999);

        $record = $this->code->createCode($this->getUser(), 'sms_confirm', $code, ttlMinutes: 5);
        $this->sms->send($phone, "Your confirmation code: $code");

        $this->logger->info('SMS code sent', ['phone' => substr($phone, -4)]);
        return new Response('OK');
    }

    #[Route('/verify', name: 'verify', methods: ['POST'])]
    public function verify(Request $request): Response
    {
        $code = (string) $request->request->get('code');
        if (!preg_match('/^\d{6}$/', $code)) {
            return new Response('Invalid code', 400);
        }

        if (!$this->code->validateAndConsume($this->getUser(), 'sms_confirm', $code)) {
            $this->logger->warning('SMS confirm failed', ['user' => $this->getUser()->getUserIdentifier()]);
            return new Response('Invalid or expired', 400);
        }

        $this->logger->info('SMS confirm success', ['user' => $this->getUser()->getUserIdentifier()]);
        return new Response('OK');
    }
    /**
     *
     * @return JsonResponse
     */
    #[Route(path: '/confirmation/sms', name: 'confirmation_sms')]
    public function smsCodeConfirmation(Request $request) : Response
    {
        # TODO//: use SmsCodeGenerator Service
        return 'TODO: use SmsCodeGenerator Service';
    }

}