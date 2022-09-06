<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints\Length;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait OldTrait
{

    #[ORM\Column(name: 'vendor_first_name', type: 'string', nullable: false, options: ['default' => 'vendor_first_name'])]
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 6, minMessage: 'vendors.en.gb.too.short')]
    private string $vendorFirstName = 'vendor_first_name';

    #[ORM\Column(name: 'vendor_last_name', type: 'string', nullable: false, options: ['default' => 'vendor_last_name'])]
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 6, minMessage: 'vendors.en.gb.too.short')]
    private ?string $vendorLastName = 'vendor_last_name';

    #[ORM\Column(name: 'vendor_middle_name', type: 'string', nullable: false, options: ['default' => 'vendor_middle_name'])]
    #[Assert\NotBlank(message: 'vendors.en.gb.blank')]
    #[Length(min: 6, minMessage: 'vendors.en.gb.too.short')]
    private ?string $vendorMiddleName = 'vendor_middle_name';

    public function getVendorFirstName(): string
    {
        return $this->vendorFirstName;
    }
    public function setVendorFirstName(string $vendorFirstName): void
    {
        $this->vendorFirstName = $vendorFirstName;
    }

    public function getVendorLastName(): string
    {
        return $this->vendorLastName;
    }
    public function setVendorLastName(string $lastName): void
    {
        $this->vendorLastName = $lastName;
    }

    public function getVendorMiddleName(): string
    {
        return $this->vendorMiddleName;
    }
    public function setVendorMiddleName(string $vendorMiddleName): void
    {
        $this->vendorMiddleName = $vendorMiddleName;
    }
}
