<?php

namespace App\Entity\Taxation;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationRateValueInterface;


use App\Entity\Traits\TimestampableTrait;
use App\Entity\Traits\SoftDeletableTrait;
#[ORM\Entity]
class TaxationValue extends RootEntity implements ObjectInterface, TaxationRateValueInterface
{
            #[ORM\Version]
    private int $version = 1;

use TimestampableTrait;
    use SoftDeletableTrait;
#[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\OneToMany(mappedBy: "taxationValue", targetEntity: Taxation::class)]
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
