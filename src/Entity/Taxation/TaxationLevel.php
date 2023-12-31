<?php

namespace App\Entity\Taxation;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTitleInterface;

#[ORM\Entity]
class TaxationLevel extends RootEntity implements ObjectInterface, ObjectTitleInterface
{

    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'taxation')]
    private ObjectProperty $objectProperty;


    #[ORM\OneToMany(mappedBy: "taxationLevel", targetEntity: Taxation::class)]
    private Collection $taxationLevel;

    public function __construct()
    {
        parent::__construct();
        $this->taxationLevel = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getTaxationLevel(): Collection
    {
        return $this->taxationLevel;
    }

    /**
     * @param Collection $taxationLevel
     */
    public function setTaxationLevel(Collection $taxationLevel): void
    {
        $this->taxationLevel = $taxationLevel;
    }



}
