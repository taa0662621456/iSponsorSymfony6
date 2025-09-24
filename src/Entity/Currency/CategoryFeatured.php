<?php

namespace App\Entity\Currency;

use App\Entity\Embeddable\ObjectProperty;
use Doctrine\ORM\Mapping as ORM;

class CategoryFeatured
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

}