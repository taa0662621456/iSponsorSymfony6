<?php

namespace App\Entity\Taxation;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationZoneInterface;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class TaxationZone extends RootEntity implements ObjectInterface, TaxationZoneInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\OneToMany(mappedBy: "taxationZone", targetEntity: Taxation::class)]
    private Collection $taxationZone;

    public function __construct()
    {
        parent::__construct();
        $this->taxationZone = new ArrayCollection();
    }


    public function getTaxationZone(): Collection
    {
        return $this->taxationZone;
    }

    public function setTaxationZone($taxationZone): void
    {
        $this->taxationZone = $taxationZone;
    }



}
