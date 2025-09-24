<?php
namespace App\Service\Security;

use App\Entity\Security\SecuritySmsCode;
use App\Repository\Security\SecuritySmsCodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;

class SecuritySmsCodeManager
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly SecuritySmsCodeRepository $repo,
        private readonly TexterInterface $texter,
        private readonly int $ttlMinutes = 5,
        private readonly int $attempts = 5
    ) {}

    public function send(string $phone): SecuritySmsCode
    {
        $code = (string)random_int(100000, 999999);
        $entity = new SecuritySmsCode($phone, $code, new \DateTimeImmutable("+{$this->ttlMinutes} minutes"), $this->attempts);
        $this->em->persist($entity);
        $this->em->flush();

        $this->texter->send(new SmsMessage($phone, "Ваш код: {$code}"));
        return $entity;
    }

    public function verify(string $phone, string $input): bool
    {
        $active = $this->repo->findActiveByPhone($phone);
        if (!$active) return false;

        $ok = $active->verify($input);
        $this->em->flush();
        return $ok;
    }
}