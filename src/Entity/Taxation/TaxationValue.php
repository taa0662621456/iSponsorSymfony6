<?php

namespace App\Entity\Taxation;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationRateValueInterface;

#[ORM\Entity]
class TaxationValue extends RootEntity implements ObjectInterface, TaxationRateValueInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'taxation')]
    private ObjectProperty $objectProperty;


    #[ORM\ManyToOne(targetEntity: Taxation::class, inversedBy: "taxationValue")]
    private Collection $taxationValue;

    public function __construct()
    {
        parent::__construct();
        $this->taxationValue = new ArrayCollection();

    }

    public function getTaxationValue(): Collection
    {
        return $this->taxationValue;
    }

    public function setTaxationValue($taxationValue): void
    {
        $this->taxationValue = $taxationValue;
    }


}
