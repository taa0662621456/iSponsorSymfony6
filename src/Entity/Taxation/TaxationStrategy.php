<?php

namespace App\Entity\Taxation;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationStrategyInterface;

#[ORM\Entity]
class TaxationStrategy extends RootEntity implements ObjectInterface, TaxationStrategyInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\ManyToOne(targetEntity: Taxation::class, inversedBy: "taxationStrategy")]
    private Collection $taxationStrategy;

    public function __construct()
    {
        parent::__construct();
        $this->taxationStrategy = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getTaxationStrategy(): Collection
    {
        return $this->taxationStrategy;
    }

    /**
     * @param Collection $taxationStrategy
     */
    public function setTaxationStrategy(Collection $taxationStrategy): void
    {
        $this->taxationStrategy = $taxationStrategy;
    }


}
