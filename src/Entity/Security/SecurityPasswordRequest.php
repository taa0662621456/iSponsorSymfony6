<?php
namespace App\Entity\Security;

use App\Entity\BaseTrait;
use App\Entity\Vendor\VendorSecurity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'security_password_request')]
#[ORM\Index(columns: ['token'], name: 'prr_token_idx')]
class SecurityPasswordRequest
{
    use BaseTrait;

    #[ORM\ManyToOne(targetEntity: VendorSecurity::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private VendorSecurity $vendor;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $usedAt = null;

    public function __construct(VendorSecurity $user, string $token, \DateTimeImmutable $ttl)
    {
        $this->vendor = $user;
    }

    public function markUsed(): void { $this->usedAt = new \DateTimeImmutable(); }
    public function getVendor(): VendorSecurity { return $this->vendor; }
}