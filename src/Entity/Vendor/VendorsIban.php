<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vendors_iban")
 * @ORM\Entity(repositoryClass="App\Repository\VendorsRepository")
 */
class VendorsIban
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
     * @var string
     *
     * @ORM\Column(name="iban", type="string", unique=true, nullable=true, options={"default"="0", "comment"="Primary Key"})
     */
    private $iban = '0';

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vendor\Vendors", cascade={"persist", "remove"}, inversedBy="vendorIban", orphanRemoval=true)
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
	private $vendorIban;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIban(): string
    {
        return $this->iban;
    }

    /**
     * @param string $iban
     */
    public function setIban(string $iban): void
    {
        $this->iban = $iban;
    }

	/**
	 * @return mixed
	 */
	public function getVendorIban()
	{
		return $this->vendorIban;
	}

	/**
	 * @param mixed $vendorIban
	 */
	public function setVendorIban($vendorIban): void
	{
		$this->vendorIban = $vendorIban;
	}
}
