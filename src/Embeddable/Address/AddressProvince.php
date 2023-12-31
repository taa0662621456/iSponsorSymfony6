<?php

namespace App\Embeddable\Address;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectApiResourceInterface;
use App\EntityInterface\Address\AddressProvinceInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Embeddable]
class AddressProvince implements ObjectInterface, ObjectApiResourceInterface, AddressProvinceInterface
{
    #[ORM\Column(type: "string")]
    private string $addressCity;

    #[ORM\Column(type: "string")]
    private string $addressProvince;

    #[ORM\Column(type: "string")]
    private string $addressCountry;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: 'address.en.gb.blank')]
    #[Length(min: 4, minMessage: 'address.en.gb.too.short')]
    #[Length(max: 7, maxMessage: 'address.en.gb.too.long')]
    private string $addressZipcode;
}
