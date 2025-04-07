<?php

namespace App\Entity\Taxation;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Object\ObjectTitleInterface;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;

#[ORM\Entity]
class TaxationEnUs extends RootEntity implements ObjectInterface, ObjectTitleInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
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
