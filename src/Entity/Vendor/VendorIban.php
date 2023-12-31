<?php

namespace App\Entity\Vendor;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Vendor\VendorIbanInterface;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity('iban')]

#[ORM\Entity]
class VendorIban extends RootEntity implements ObjectInterface, VendorIbanInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'vendor')]
    private ObjectProperty $objectProperty;

    #[ORM\Column(name: 'iban', nullable: true, options: ['default' => '0'])]
    #[Assert\Iban(message: 'Номер счета должен иметь международный формат. Например, для Украины: UA85 3996 2200 0000 0260 0123 3566 1')]
    private ?string $vendorIbanAccount = null;

    #[ORM\Column(name: 'expires_end', nullable: true, options: ['default' => '0'])]
    private ?string $vendorIbanExpiresEnd = null;

    #[ORM\Column(name: 'signature_code', type: 'smallint', options: ['default' => 0])]
    private ?int $vendorIbanSignatureCode = 0;

    #[ORM\OneToOne(inversedBy: 'vendorIban', targetEntity: Vendor::class, orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Ignore]
    private Vendor $vendorIban;
}
