<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;

/**
 * vendorIban
 *
 * @ORM\Table(name="vendors_iban", uniqueConstraints={
 * @ORM\UniqueConstraint(name="userid", columns={"userid"})})
 * @ORM\Entity
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
     * @ORM\Column(name="vendor_iban", type="string", nullable=false, options={"default"="0"})
     */
    private $vendorIban = '0';

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vendor\Vendors", cascade={"persist", "remove"}, inversedBy="iban", orphanRemoval=true)
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $iban;

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
    public function getVendorIban(): string
    {
        return $this->vendorIban;
    }

    /**
     * @param string $vendorIban
     */
    public function setVendorIban(string $vendorIban): void
    {
        $this->iban = $vendorIban;
    }

}
