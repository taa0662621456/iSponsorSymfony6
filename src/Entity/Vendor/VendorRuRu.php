<?php


namespace App\Entity\Vendor;


use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vendors_ru_ru", indexes={
 * @ORM\Index(name="vendor_ru_ru_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class VendorRuRu
{
    use BaseTrait;
    use ObjectTrait;
    use VendorLanguageTrait;


}
