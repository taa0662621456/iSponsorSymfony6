<?php

namespace App\Entity\Vendor;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\VendorLanguageTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="vendors_profile", indexes={
 * @ORM\Index(name="vendor_profile_idx", columns={"slug", "vendor_phone"})}, uniqueConstraints={
 * @ORM\UniqueConstraint(name="vendor_profile_idx", columns={"slug", "vendor_phone"})})
 * @UniqueEntity("vendor_phone",
 *        errorPath="vendor_phone",
 *        message="phone.already.use")
 * @UniqueEntity("slug",
 *        errorPath="slug",
 *        message="slug.already.use")
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorProfileRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 * @ApiResource()
 *
 */
class VendorProfile
{
    use VendorLanguageTrait;
    use ObjectTrait;
    use BaseTrait;
}
