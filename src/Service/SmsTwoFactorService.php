<?php
namespace App\Service;

use App\Entity\Vendor\VendorSecurity;
use App\ServiceInterface\TwoFactorServiceInterface;
use Symfony\Component\Notifier\Exception\TransportExceptionInterface;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;

class SmsTwoFactorService implements TwoFactorServiceInterface
{
    public function __construct(
        private readonly TexterInterface $texter
    ) {}

    /**
     * @throws TransportExceptionInterface
     */
    public function prepare(VendorSecurity $user): void
    {
        // Генерим 6-значный код
        $code = random_int(100000, 999999);
        $user->setTwoFactorCode((string)$code);
        $user->setTwoFactorExpiresAt(new \DateTimeImmutable('+5 minutes'));

        // Шлём SMS
        $sms = new SmsMessage(
            (string)$user->getPhone(),
            sprintf('Ваш код подтверждения: %s', $code)
        );
        $this->texter->send($sms);
    }

    public function validate(VendorSecurity $user, string $code): bool
    {
        return $user->getTwoFactorCode() === $code &&
            $user->getTwoFactorExpiresAt() > new \DateTimeImmutable();
    }

    public function getMethodName(): string
    {
        return 'sms';
    }
}
