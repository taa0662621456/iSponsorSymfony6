<?php

namespace App\Entity\Taxation;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Object\ObjectTitleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;

#[ORM\Entity]
class TaxationRate extends RootEntity implements ObjectInterface, ObjectTitleInterface
{

    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\OneToMany(mappedBy: "taxationRate", targetEntity: Taxation::class)]
    private Collection $taxationRate;

    public function __construct()
    {
        parent::__construct();
        $this->taxationRate = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getTaxationRate(): Collection
    {
        return $this->taxationRate;
    }

    /**
     * @param Collection $taxationRate
     */
    public function setTaxationRate(Collection $taxationRate): void
    {
        $this->taxationRate = $taxationRate;
    }



}
