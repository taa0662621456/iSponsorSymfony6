<?php

namespace App\Entity\Taxation;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTitleInterface;

#[ORM\Entity]
class TaxationEnUs extends RootEntity implements ObjectInterface, ObjectTitleInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'taxation')]
    private ObjectProperty $objectProperty;


    #[ORM\OneToOne(targetEntity: Taxation::class)]
    private Taxation $taxationEnUs;

    /**
     * @return Taxation
     */
    public function getTaxationEnUs(): Taxation
    {
        return $this->taxationEnUs;
    }

    /**
     * @param Taxation $taxationEnUs
     */
    public function setTaxationEnUs(Taxation $taxationEnUs): void
    {
        $this->taxationEnUs = $taxationEnUs;
    }


}
