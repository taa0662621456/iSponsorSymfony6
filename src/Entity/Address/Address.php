<?php

namespace App\Entity\Address;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\GeoAddressFilterTrait;
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Controller\ObjectCRUDsController;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Address\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Table(name: 'address')]
#[ORM\Index(columns: ['slug'], name: 'address_idx')]
#[ORM\Entity(repositoryClass: AddressRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource(
    operations: [
        new GetCollection(
            paginationEnabled: false,
            order: ['createdAt' => 'DESC'],
            normalizationContext: ['groups' => ['read','list']],
            denormalizationContext: ['groups' => ['write']]
        ),
        new Get(
            normalizationContext: ['groups' => ['read','item']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Put(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Delete(),
        new Get(
            uriTemplate: '/{_entity}/show/{slug}',
            controller: ObjectCRUDsController::class,
            normalizationContext: ['groups' => ['read','item']],
            name: 'get_by_slug'
        )
    ]
)]
class Address
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    #
    use TimestampFilterTrait;
    use GeoAddressFilterTrait;
    use RelationFilterTrait;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Groups(['read', 'write', 'list', 'item'])]
    private string $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Groups(['read', 'write', 'list', 'item'])]
    private string $lastName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['read', 'write', 'list', 'item'])]
    private ?string $phoneNumber = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['read', 'write', 'list', 'item'])]
    private ?string $company = null;

    #[ORM\Column(type: 'string', length: 2)]
    #[Assert\NotBlank]
    #[Groups(['read', 'write', 'list', 'item'])]
    private string $countryCode;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['read', 'write', 'list', 'item'])]
    private ?string $provinceCode = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['read', 'write', 'list', 'item'])]
    private ?string $provinceName = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Groups(['read', 'write', 'list', 'item'])]
    private string $street;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Groups(['read', 'write', 'list', 'item'])]
    private string $city;

    #[ORM\Column(type: 'string', length: 64)]
    #[Assert\NotBlank]
    #[Groups(['read', 'write', 'list', 'item'])]
    private string $postcode;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): void
    {
        $this->company = $company;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    public function getProvinceCode(): ?string
    {
        return $this->provinceCode;
    }

    public function setProvinceCode(?string $provinceCode): void
    {
        $this->provinceCode = $provinceCode;
    }

    public function getProvinceName(): ?string
    {
        return $this->provinceName;
    }

    public function setProvinceName(?string $provinceName): void
    {
        $this->provinceName = $provinceName;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): void
    {
        $this->postcode = $postcode;
    }

    public function getZip(): string
    {
        return $this->postcode;
    }

    public function setZip(string $postcode): void
    {
        $this->postcode = $postcode;
    }

    public function setCountry(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    public function setStreetLine(string $streetLine): void
    {
        $this->street = $streetLine;
    }
}
