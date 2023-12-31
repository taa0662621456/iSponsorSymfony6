<?php

namespace App\Entity\Taxation;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;

#[ORM\Entity]
class TaxationType extends RootEntity implements ObjectInterface
{

    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'taxation')]
    private ObjectProperty $objectProperty;


    #[ORM\OneToMany(mappedBy: "taxationType", targetEntity: Taxation::class)]
    private Collection $taxationType;

    public function __construct()
    {
        parent::__construct();
        $this->taxationType = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getTaxationType(): ArrayCollection
    {
        return $this->taxationType;
    }

    /**
     * @param ArrayCollection $taxationType
     */
    public function setTaxationType(ArrayCollection $taxationType): void
    {
        $this->taxationType = $taxationType;
    }


}
