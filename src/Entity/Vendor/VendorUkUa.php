<?php


namespace App\Entity\Vendor;


use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vendors_uk_ua", indexes={
 * @ORM\Index(name="vendor_uk_ua_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class VendorUkUa
{
    use BaseTrait;
    use ObjectTrait;
    use VendorLanguageTrait;

}
