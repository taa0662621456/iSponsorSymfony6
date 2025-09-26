<?php


namespace App\Entity\Commission;

use App\Entity\Product\Product;
use App\Entity\Vendor\Vendor;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Commission\CommissionRepository;
use DateTime;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CommissionRepository::class)]
#[ORM\Table(
    name: 'commissions',
    indexes: [
        new ORM\Index(columns: ['vendor_id'], name: 'idx_commission_vendor'),
        new ORM\Index(columns: ['product_id'], name: 'idx_commission_product'),
        new ORM\Index(columns: ['effective_from'], name: 'idx_commission_effective_from')
    ],
    uniqueConstraints: [
        new ORM\UniqueConstraint(
            name: 'uniq_vendor_product_date',
            columns: ['vendor_id', 'product_id', 'effective_from']
        )
    ]
)]
class Commission
{
    use BaseTrait;
    use ObjectTrait;

    #[Assert\Range(min: 0, max: 100)]
    #[ORM\Column(type: 'decimal', precision: 5, scale: 2)]
    private string $percentage;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'commissions')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Vendor $vendor = null;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'commissions')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Product $product = null;

    public function getVendor(): ?Vendor
    {
        return $this->vendor;
    }

    public function setVendor(?Vendor $vendor): void
    {
        $this->vendor = $vendor;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): void
    {
        $this->product = $product;
    }

    //TODO: комиссии, налагаемые на способы доставки, оплаты и пр.
    /**
     * incrementCommission
     * decrementCommission
     * additionCommission
     * multiplicationCommission
     * subtractionCommission
     *
     * percentCommission
     * fixedCommission
     *
     * toShipment
     * toPayment
     * toPrice
     * toDate
     * toPlatformReward
     * toStorage
     * toProjectType
     * toOrderTotal
     * toProductCategory
     *
     *
     */
    public function __construct()
    {
        $t = new \DateTimeImmutable();
        $this->slug = (string)Uuid::v4();

        $this->lastRequestAt = $t;
        $this->createdAt = $t;
        $this->modifiedAt = $t;
        $this->lockedAt = $t;
        $this->published = true;
    }

}
