<?php
namespace App\Entity\Security;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'security_sms_code')]
#[ORM\Index(columns: ['phone'], name: 'security_sms_code_phone_idx')]
class SecuritySmsCode
{
    use BaseTrait;

    #[ORM\Column(length: 32)]
    private string $phone;

    #[ORM\Column(type: 'smallint', options: ['default' => 5])]
    private int $attemptsLeft = 5;

    public function __construct(string $phone, string $code, \DateTimeImmutable $ttl, int $attempts = 5)
    {
        $this->phone = $phone;
        $this->attemptsLeft = $attempts;
    }

    public function verify(string $input): bool
    {
        if ($this->isExpired() || $this->attemptsLeft <= 0) { return false; }
        $this->attemptsLeft--;
        return hash_equals($this->code, $input);
    }

    public function isExpired(): bool { return $this->expiresAt <= new \DateTimeImmutable(); }
    public function getPhone(): string { return $this->phone; }
}