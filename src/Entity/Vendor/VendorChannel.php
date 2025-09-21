<?php

namespace App\Entity\Vendor;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Vendor\VendorChannelInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class VendorChannel extends RootEntity implements ObjectInterface, VendorChannelInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'channels')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Vendor $vendor = null;

    public function __construct()
    {
        parent::__construct();
        $this->objectProperty = new ObjectProperty();
    }

    public function getObjectProperty(): ObjectProperty
    {
        return $this->objectProperty;
    }

    // Прокси для ObjectProperty

    public function getCode(): ?string
    {
        return $this->objectProperty->getCode();
    }

    public function setCode(string $code): void
    {
        $this->objectProperty->setCode($code);
    }

    public function getName(): ?string
    {
        return $this->objectProperty->getName();
    }

    public function setName(string $name): void
    {
        $this->objectProperty->setName($name);
    }

    public function getSlug(): ?string
    {
        return $this->objectProperty->getSlug();
    }

    public function setSlug(string $slug): void
    {
        $this->objectProperty->setSlug($slug);
    }

    public function getVendor(): ?Vendor
    {
        return $this->vendor;
    }

    public function setVendor(?Vendor $vendor): void
    {
        $this->vendor = $vendor;
    }

    public function __toString(): string
    {
        return $this->getName() ?? $this->getCode() ?? 'Channel';
    }
}
