<?php


namespace App\Entity\Product;

use App\Entity\BaseTrait;
use App\Entity\Featured\Featured;
use App\Entity\MetaTrait;
use App\Entity\ObjectTrait;
use App\Entity\Order\OrderItem;
use App\Entity\Project\Project;
use App\Entity\Project\ProjectFavourite;

use App\Repository\Product\ProductRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

#[ORM\Table(name: 'product_attribute')]
#[ORM\Index(columns: ['slug'], name: 'product_attribute_idx')]
#[ORM\Entity(repositoryClass: ProductAttributeRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProductAttribute
{

    use BaseTrait;

    public const ATTRIBUTE_TYPE_BOOLEAN = 'boolean';

    public const ATTRIBUTE_TYPE_DATE = 'date';

    public const ATTRIBUTE_TYPE_DATETIME = 'datetime';

    public const ATTRIBUTE_TYPE_FLOAT = 'float';

    public const ATTRIBUTE_TYPE_INTEGER = 'integer';

    public const ATTRIBUTE_TYPE_JSON = 'json';

    public const ATTRIBUTE_TYPE_TEXT = 'text';

    public const NUM_ITEMS = 10;


    /** @var string|null */
    private ?string $text;

    /** @var bool|null */
    private ?bool $boolean;

    /** @var int|null */
    private ?int $integer;

    /** @var float|null */
    private ?float $float;

    /** @var \DateTimeInterface|null */
    private ?\DateTimeInterface $datetime;

    /** @var \DateTimeInterface|null */
    private ?\DateTimeInterface $date;

    /** @var array|null */
    private ?array $json;

}
