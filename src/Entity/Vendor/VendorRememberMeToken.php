<?php

namespace App\Entity\Vendor;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class VendorRememberMeToken extends RootEntity
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'vendor')]
    private ObjectProperty $objectProperty;

    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $series = 0;

    #[ORM\Column(type: 'string')]
    private string $value;

    #[ORM\Column(type: 'string')]
    private string $lastUsed;

    #[ORM\Column(type: 'string')]
    private string $class;

    #[ORM\Column(type: 'string')]
    private string $username;

    public function __construct()
    {
        parent::__construct();
        $t = new \DateTime();
        $this->lastUsed = $t->format('Y-m-d H:i:s');
    }
}
