<?php

namespace App\Entity\Product;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Product\ProductAttributeInterface;
use App\Repository\Product\ProductProductAttributeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_attribute')]
#[ORM\Index(columns: ['slug'], name: 'product_attribute_idx')]
#[ORM\Entity(repositoryClass: ProductProductAttributeRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class ProductAttribute extends ObjectSuperEntity implements ObjectInterface, ProductAttributeInterface
{
    public const ATTRIBUTE_TYPE_BOOLEAN = 'boolean';

    public const ATTRIBUTE_TYPE_DATE = 'date';

    public const ATTRIBUTE_TYPE_DATETIME = 'datetime';

    public const ATTRIBUTE_TYPE_FLOAT = 'float';

    public const ATTRIBUTE_TYPE_INTEGER = 'integer';

    public const ATTRIBUTE_TYPE_JSON = 'json';

    public const ATTRIBUTE_TYPE_TEXT = 'text';

    public const NUM_ITEMS = 10;

    private ?string $text;

    private ?bool $boolean;

    private ?int $integer;

    private ?float $float;

    private ?\DateTimeInterface $datetime;

    private ?\DateTimeInterface $date;

    private ?array $json;

    public function getType()
    {
        // TODO: Implement getType() method.
    }
}
