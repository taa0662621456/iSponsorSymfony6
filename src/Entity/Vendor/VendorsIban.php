<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;

/**
 * vendorIban
 *
 * @ORM\Table(name="vendors_iban", uniqueConstraints={
 * @ORM\UniqueConstraint(name="userid", columns={"userid"})})
 * @ORM\Entity(repositoryClass="App\Repository\VendorsRepository")
 */
class VendorsIban
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="iban", type="string", nullable=false, options={"default"="0"})
     */
    private $iban = '0';

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vendor\Vendors", cascade={"persist", "remove"}, inversedBy="vendorIban", orphanRemoval=true)
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
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
