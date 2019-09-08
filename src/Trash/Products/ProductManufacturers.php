<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProductManufacturers
 *
 * @ORM\Table(name="product_manufacturers", uniqueConstraints={@ORM\UniqueConstraint(name="product_id", columns={"product_id", "manufacturer_id"})})
 * @ORM\Entity
 */
class ProductManufacturers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer|null
     *
     * @ORM\Column(name="product_id", type="integer", nullable=true, options={"default":0})
     */
    private $productId = '0';

    /**
     * @var integer|null
     *
     * @ORM\Column(name="manufacturer_id", type="integer", nullable=true, options={"default":0})
     */
    private $manufacturerId = '0';


}
