<?php


namespace App\Entity\Vendor;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Vendor\VendorIbanRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'vendor_iban')]
#[ORM\Index(columns: ['slug'], name: 'vendor_iban_idx')]
#[UniqueEntity('iban')]
#[ORM\Entity(repositoryClass: VendorIbanRepository::class)]
#
#[ApiResource()]
class VendorIban
{
	use BaseTrait;
    use ObjectTrait;

	#[ORM\Column(name: 'iban', nullable: true, options: ['default' => '0'])]
	#[Assert\Iban(message: 'Номер счета должен иметь международный формат. Например, для Украины: UA85 3996 2200 0000 0260 0123 3566 1')]
	private ?string $iban = null;

	#[ORM\Column(name: 'expires_end', nullable: true, options: ['default' => '0'])]
	private ?string $expiresEnd = null;

	#[ORM\Column(name: 'signature_code', type: 'smallint', options: ['default' => 0])]
	private ?int $signatureCode = 0;

	#[ORM\OneToOne(inversedBy: 'vendorIban', targetEntity: Vendor::class, orphanRemoval: true)]
	#[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Ignore]
	private Vendor $vendorIbanVendor;

    public function getIban(): ?string
    {
        return $this->iban;
    }
    public function setIban(?string $iban): void
    {
        $this->iban = $iban;
    }

    # OneToOne
    public function getVendorIbanVendor(): Vendor
    {
        return $this->vendorIbanVendor;
    }
    public function setVendorIbanVendor(Vendor $iban): void
    {
     $this->vendorIbanVendor = $iban;
    }

    public function getExpiresEnd(): string
	{
		return $this->expiresEnd;
	}
    public function setExpiresEnd(string $expiresEnd): void
	{
		$this->expiresEnd = $expiresEnd;
	}

    public function getSignatureCode(): int
	{
		return $this->signatureCode;
	}
    public function setSignatureCode(int $signatureCode): void
	{
		$this->signatureCode = $signatureCode;
	}
}
