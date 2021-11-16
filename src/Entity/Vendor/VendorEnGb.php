<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="vendors_en_gb", indexes={
 * @ORM\Index(name="vendor_en_gb_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class VendorEnGb
{
    use BaseTrait;
    use ObjectTrait;
    use VendorLanguageTrait;
}
