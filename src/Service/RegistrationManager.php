<?php

namespace App\Service;

use App\Entity\Vendor\Vendor;
use App\Entity\Vendor\VendorSecurity;
use App\Entity\Vendor\VendorEnGb;
use Doctrine\ORM\EntityManagerInterface;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3Validator;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use Symfony\Component\Notifier\Exception\TransportExceptionInterface;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Mailer\MailerInterface;

class RegistrationManager
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly LoggerInterface $logger,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly EmailConfirmation $emailConfirmation,
        private readonly Recaptcha3Validator $recaptchaValidator,
        private readonly TexterInterface $texter,
        private readonly MailerInterface $mailer,
        private readonly string $notificationSender,
        private readonly string $senderName,
        private readonly float $recaptchaMinScore,
    ) {}

    /**
     * Основная регистрация
     * @throws \Throwable
     */
    public function registerVendor(array $data): VendorSecurity
    {
        $this->logger->info('Регистрация нового пользователя', ['email' => $data['email']]);

        // --- Проверка reCAPTCHA ---
        $score = $this->recaptchaValidator->getLastResponse()->getScore();
        if ($score < $this->recaptchaMinScore) {
            $this->logger->warning('Подозрительная регистрация (низкий reCAPTCHA)', [
                'email' => $data['email'],
                'score' => $score
            ]);
            // Отправим SMS как дополнительный барьер
            $this->sendSmsVerification($data['phone']);
        }

        // --- Сборка сущностей ---
        $vendor = new Vendor();
        $vendorSecurity = new VendorSecurity();
        $vendorEnGb = new VendorEnGb();

        $vendorSecurity->setEmail((string) $data['email']);
        $vendorSecurity->setPhone((string) $data['phone']);

        $hashedPassword = $this->passwordHasher->hashPassword($vendorSecurity, (string) $data['plainPassword']);
        $vendorSecurity->setPassword($hashedPassword);

        $vendorEnGb->setVendorPhone((string) $data['phone']);
        $vendor->setVendorSecurity($vendorSecurity);
        $vendor->setVendorEnGb($vendorEnGb);

        // --- Persist ---
        try {
            $this->em->persist($vendorSecurity);
            $this->em->persist($vendorEnGb);
            $this->em->persist($vendor);
            $this->em->flush();
        } catch (\Throwable $e) {
            $this->logger->error('Ошибка сохранения в БД при регистрации', ['error' => $e->getMessage()]);
            throw $e;
        }

        // --- Email подтверждение ---
        $this->sendEmailConfirmation($vendorSecurity);

        $this->logger->notice('Успешная регистрация пользователя', ['email' => $vendorSecurity->getEmail()]);

        return $vendorSecurity;
    }

    /**
     * Отправка SMS с кодом
     */
    private function sendSmsVerification(string $phone): void
    {
        try {
            $sms = new SmsMessage($phone, 'Привет! Ваш код подтверждения: 123456');
            $this->texter->send($sms);
            $this->logger->info('Отправлено SMS подтверждение', ['phone' => $phone]);
        } catch (TransportExceptionInterface $e) {
            $this->logger->error('Не удалось отправить SMS', ['phone' => $phone, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Отправка email-подтверждения
     */
    private function sendEmailConfirmation(VendorSecurity $vendorSecurity): void
    {
        try {
            $email = (new TemplatedEmail())
                ->from(new Address($this->notificationSender, $this->senderName))
                ->to($vendorSecurity->getEmail())
                ->subject('Подтвердите вашу регистрацию')
                ->htmlTemplate('registration/confirmation_email.html.twig')
                ->context([
                    'vendor' => $vendorSecurity,
                    'confirmationLink' => '/auth/confirm/' . $vendorSecurity->getSlug(),
                ]);

            $this->mailer->send($email);
        } catch (\Throwable $e) {
            $this->logger->error('Не удалось отправить email подтверждение', [
                'email' => $vendorSecurity->getEmail(),
                'error' => $e->getMessage()
            ]);
        }
    }
}
