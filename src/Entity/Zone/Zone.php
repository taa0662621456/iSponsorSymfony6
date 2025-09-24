<?php

namespace App\Entity\Zone;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Zone\ZoneInterface;

#[ORM\Entity]
class Zone extends RootEntity implements ObjectInterface, ZoneInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\Column(name: 'zip_zone', type: 'string', nullable: true, options: ['default' => '00000-99999'])]
    private ?string $zipZone;

    /**
     * @return string|null
     */
    public function getZipZone(): ?string
    {
        return $this->zipZone;
    }

    /**
     * @param string|null $zipZone
     */
    public function setZipZone(?string $zipZone): void
    {
        $this->zipZone = $zipZone;
    }


}