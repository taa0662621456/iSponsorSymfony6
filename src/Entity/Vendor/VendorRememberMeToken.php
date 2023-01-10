<?php


namespace App\Entity\Vendor;


use App\Entity\ObjectBaseTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'remember_me_token')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class VendorRememberMeToken
{
    use ObjectBaseTrait;

    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $series = 0;

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
        $t = new DateTime();
        $this->lastUsed = $t->format('Y-m-d H:i:s');
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
        $t = new DateTime();
        $this->lastUsed = $t->format('Y-m-d H:i:s');
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
