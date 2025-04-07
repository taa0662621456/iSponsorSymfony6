<?php

namespace App\Entity\Taxation;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationCategoryInterface;

#[ORM\Entity]
class TaxationCategory extends RootEntity implements ObjectInterface, TaxationCategoryInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\OneToMany(mappedBy: "taxationCategory", targetEntity: Taxation::class)]
    private Collection $taxationCategory;

    public function __construct()
    {
        parent::__construct();

        $this->taxationCategory = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getTaxationCategory(): Collection
    {
        return $this->taxationCategory;
    }

    /**
     * @param Collection $taxationCategory
     */
    public function setTaxationCategory(Collection $taxationCategory): void
    {
        $this->taxationCategory = $taxationCategory;
    }


}
