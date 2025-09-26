<?php


namespace App\Entity\Vendor;


use App\Entity\BaseTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;


#[ORM\Table(
    name: 'remember_me_token',
    indexes: [
        new ORM\Index(columns: ['vendor_id'], name: 'idx_rememberme_vendor')
    ],
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_rememberme_series', columns: ['series'])
    ]
)]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class VendorRememberMeToken
{
    use BaseTrait;

    #[ORM\Column(type: 'integer', length: 88, unique: true)]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $series;

    #[ORM\Column(type: 'string')]
    private string $value;

    #[ORM\Column(type: 'string')]
    private string $lastUsed;

    #[ORM\Column(type: 'string')]
    private string $class;

    #[ORM\Column(type: 'string')]
    private string $username;
    public function __construct()
    {
        $t = new \DateTimeImmutable();
        $this->lastUsed = $t;
    }
    public function getSeries(): int
    {
        return $this->series;
    }
    public function setSeries(int $series): void
    {
        $this->series = $series;
    }
    public function getValue(): string
    {
        return $this->value;
    }
    public function setValue(string $value): void
    {
        $this->value = $value;
    }
    public function getLastUsed(): string
    {
        return $this->lastUsed;
    }
    public function setLastUsed(string $lastUsed): void
    {
        $t = new \DateTimeImmutable();
        $this->lastUsed = $t;
    }
    public function getClass(): string
    {
        return $this->class;
    }
    public function setClass(string $class): void
    {
        $this->class = $class;
    }
    public function getUsername(): string
    {
        return $this->username;
    }
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
}
