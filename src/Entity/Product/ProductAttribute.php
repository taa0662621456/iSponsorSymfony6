<?php

namespace App\Entity\Product;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductAttributeInterface;

#[ORM\Entity]
class ProductAttribute extends RootEntity implements ObjectInterface, ProductAttributeInterface
{
    public const ATTRIBUTE_TYPE_BOOLEAN = 'boolean';

    public const ATTRIBUTE_TYPE_DATE = 'date';

    public const ATTRIBUTE_TYPE_DATETIME = 'datetime';

    public const ATTRIBUTE_TYPE_FLOAT = 'float';

    public const ATTRIBUTE_TYPE_INTEGER = 'integer';

    public const ATTRIBUTE_TYPE_JSON = 'json';

    public const ATTRIBUTE_TYPE_TEXT = 'text';

    public const NUM_ITEMS = 10;

    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    private ?string $text;

    private ?bool $boolean;

    private ?int $integer;

    private ?float $float;

    private ?DateTimeInterface $datetime;

    private ?DateTimeInterface $date;

    private ?array $json;
}
