<?php

namespace App\Entity\Taxation;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationInterface;

#[ORM\Entity]
class Taxation extends RootEntity implements ObjectInterface, TaxationInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'taxation')]
    private ObjectProperty $objectProperty;


    #[ORM\ManyToOne(targetEntity: TaxationType::class, inversedBy: "taxationType")]
    private TaxationType $taxationType;

    #[ORM\ManyToOne(targetEntity: TaxationZone::class, inversedBy: "taxationZone")]
    private TaxationZone $taxationZone;

    #[ORM\ManyToOne(targetEntity: TaxationLevel::class, inversedBy: "taxationLevel")]
    private TaxationLevel $taxationLevel;

    #[ORM\OneToMany(mappedBy: "taxationValue", targetEntity: TaxationValue::class)]
    private ArrayCollection $taxationValue;

    public function __construct()
    {
        parent::__construct();
        $this->taxationValue = new ArrayCollection();

    }


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

    public function getTaxationValue(): ArrayCollection
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
            if ($taxationValue->getTaxationValue() === $this) {
                $taxationValue->setTaxationValue(null);
            }
        }

        return $this;
    }





}
