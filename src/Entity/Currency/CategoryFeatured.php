<?php

namespace App\Entity\Currency;

use App\Embeddable\Object\ObjectProperty;
use Doctrine\ORM\Mapping as ORM;

class CategoryFeatured
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'currency')]
    private ObjectProperty $objectProperty;

}
