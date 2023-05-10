<?php

namespace App\DTO\Vendor;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity('iban')]

final class VendorIbanDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    #[Assert\Iban(message: 'Номер счета должен иметь международный формат. Например, для Украины: UA85 3996 2200 0000 0260 0123 3566 1')]
    private ?string $iban = null;

    private ?string $expiresEnd = null;

    private ?int $signatureCode = 0;

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
