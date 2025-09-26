<?php

namespace App\Service;

use App\Entity\Vendor\VendorSecurity;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Notifier\Exception\TransportExceptionInterface;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;
use Symfony\Component\Mailer\MailerInterface;

class VerificationManager
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly LoggerInterface $logger,
        private readonly MailerInterface $mailer,
        private readonly TexterInterface $texter,
        private readonly string $notificationSender,
        private readonly string $senderName,
    ) {}

    /**
     * Генерация кода подтверждения (например, для SMS/Email).
     */
    public function generateCode(int $length = 6): string
    {
        return (string)random_int(10 ** ($length - 1), (10 ** $length) - 1);
    }

    /**
     * Сохраняем код в сущность (например, в VendorSecurity).
     */
    public function assignVerificationCode(VendorSecurity $user, string $code): void
    {
        $user->setVerificationCode($code);
        $user->setVerificationExpiresAt(new \DateTimeImmutable('+10 minutes'));
        $this->em->persist($user);
        $this->em->flush();
    }

    /**
     * Проверка кода подтверждения.
     */
    public function validateCode(VendorSecurity $user, string $code): bool
    {
        if ($user->getVerificationCode() !== $code) {
            return false;
        }
        if ($user->getVerificationExpiresAt() < new \DateTimeImmutable()) {
            return false;
        }
        return true;
    }

    /**
     * Отправка Email-подтверждения с кодом.
     */
    public function sendEmailCode(VendorSecurity $user, string $code, string $template = 'registration/email_code.html.twig'): void
    {
        try {
            $email = (new TemplatedEmail())
                ->from(new Address($this->notificationSender, $this->senderName))
                ->to($user->getEmail())
                ->subject('Ваш код подтверждения')
                ->htmlTemplate($template)
                ->context([
                    'vendor' => $user,
                    'code' => $code,
                ]);

            $this->mailer->send($email);
            $this->logger->info('Отправлен email-код подтверждения', ['email' => $user->getEmail()]);
        } catch (\Throwable $e) {
            $this->logger->error('Ошибка отправки email-кода', [
                'email' => $user->getEmail(),
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Отправка SMS-подтверждения с кодом.
     */
    public function sendSmsCode(VendorSecurity $user, string $code): void
    {
        if (!$user->getPhone()) {
            $this->logger->warning('Невозможно отправить SMS: у пользователя нет телефона', ['id' => $user->getId()]);
            return;
        }

        try {
            $sms = new SmsMessage($user->getPhone(), "Ваш код подтверждения: {$code}");
            $this->texter->send($sms);
            $this->logger->info('Отправлен SMS-код подтверждения', ['phone' => $user->getPhone()]);
        } catch (TransportExceptionInterface $e) {
            $this->logger->error('Ошибка отправки SMS-кода', [
                'phone' => $user->getPhone(),
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Унифицированная функция: генерируем код, сохраняем, шлём (email + sms).
     */
    public function dispatchVerification(VendorSecurity $user, bool $withSms = true, bool $withEmail = true): string
    {
        $code = $this->generateCode();
        $this->assignVerificationCode($user, $code);

        if ($withEmail) {
            $this->sendEmailCode($user, $code);
        }
        if ($withSms) {
            $this->sendSmsCode($user, $code);
        }

        return $code;
    }
}
