<?php

namespace App\Entity\Taxation;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationInterface;

#[ORM\Entity]
class Taxation extends RootEntity implements ObjectInterface, TaxationInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\OneToMany(mappedBy: "taxationStrategy", targetEntity: TaxationStrategy::class)]
    private Collection $taxationStrategy;

    #[ORM\ManyToOne(targetEntity: TaxationType::class, inversedBy: "taxationType")]
    private TaxationType $taxationType;

    #[ORM\ManyToOne(targetEntity: TaxationZone::class, inversedBy: "taxationZone")]
    private TaxationZone $taxationZone;

    #[ORM\ManyToOne(targetEntity: TaxationLevel::class, inversedBy: "taxationLevel")]
    private TaxationLevel $taxationLevel;

    #[ORM\ManyToOne(targetEntity: TaxationValue::class, inversedBy: "taxationValue")]
    private ?TaxationValue $taxationValue = null;

    #[ORM\ManyToOne(targetEntity: TaxationRate::class, inversedBy: "taxationRate")]
    private ?TaxationRate $taxationRate = null;

    #[ORM\ManyToOne(targetEntity: TaxationCategory::class, inversedBy: "taxationCategory")]
    private ?TaxationCategory $taxationCategory = null;

    public function getTaxationType(): TaxationType
    {
        return $this->taxationType;
    }

    public function setTaxationType(TaxationType $taxationType): void
    {
        $this->taxationType = $taxationType;
    }

    public function getTaxationZone(): TaxationZone
    {
        return $this->taxationZone;
    }

    public function setTaxationZone(TaxationZone $taxationZone): void
    {
        $this->taxationZone = $taxationZone;
    }

    public function getTaxationLevel(): TaxationLevel
    {
        return $this->taxationLevel;
    }

    public function setTaxationLevel(TaxationLevel $taxationLevel): void
    {
        $this->taxationLevel = $taxationLevel;
    }

    public function getTaxationValue(): TaxationValue
    {
        return $this->taxationValue;
    }

    public function setTaxationValue($taxationValue): void
    {
        $this->addTaxationValue($taxationValue);
    }

    public function addTaxationValue(TaxationValue $taxationValue): self
    {
        if (!$this->taxationValue->contains($taxationValue)) {
            $this->taxationValue[] = $taxationValue;
            $taxationValue->setTaxationValue($this);
        }

        return $this;
    }

    public function removeTaxationValue(TaxationValue $taxationValue): self
    {
        if ($this->taxationValue->removeElement($taxationValue)) {
        }

        return $this;
    }





}
