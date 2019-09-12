<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="featured")
 * @ORM\Entity(repositoryClass="App\Repository\FeaturedRepository")
 */
class Featured
{
    /**
     * @var integer
	 *
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="orderid", type="integer")
     */
    private $orderId;

    /**
     * @var string
     *
     * @ORM\Column(name="featured_type", type="string")
     */
    private $featuredType;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

	/**
	 * @param $orderId
	 *
	 * @return Featured
	 */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }
    /**
     * @return integer
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getFeaturedType(): string
    {
        return $this->featuredType;
    }

    /**
     * @param string $featuredType
     */
    public function setFeaturedType(string $featuredType): void
    {
        $this->featuredType = $featuredType;
    }

}