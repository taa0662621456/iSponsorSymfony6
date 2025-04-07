<?php

namespace App\Entity\Storage;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\Embeddable\Object\ObjectTitle;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Storage\StorageInterface;
use App\EntityInterface\Object\ObjectInterface;

#[ORM\Entity]
class Storage extends RootEntity implements ObjectInterface, StorageInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\Column(name: 'storage_stock_quantity', type: 'integer')]
    private int $storageStockQuantity;


    /**
     * @return int
     */
    public function getStorageStockQuantity(): int
    {
        return $this->storageStockQuantity;
    }

    /**
     * @param int $storageStockQuantity
     */
    public function setStorageStockQuantity(int $storageStockQuantity): void
    {
        $this->storageStockQuantity = $storageStockQuantity;
    }


}
