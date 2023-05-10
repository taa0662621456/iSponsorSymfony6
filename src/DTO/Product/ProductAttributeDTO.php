<?php

namespace App\DTO\Product;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

final class ProductAttributeDTO extends ObjectDTO implements ObjectApiResourceInterface
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
