<?php
declare(strict_types=1);

namespace App\Entity\Vendor;


use App\Entity\BaseTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="rememberme_token")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class VendorRememberMeToken
{
    use BaseTrait;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     * Groups({"object:list", "object:item"})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $series = 0;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $value;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $lastUsed;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $class;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $username;


    public function __construct()
    {
        $t = new DateTime();
        $this->lastUsed = $t->format('Y-m-d H:i:s');
    }

    /**
     * @return int
     */
    public function getSeries(): int
    {
        return $this->series;
    }

    /**
     * @param int $series
     */
    public function setSeries(int $series): void
    {
        $this->series = $series;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getLastUsed(): string
    {
        return $this->lastUsed;
    }

    /**
     * @param string $lastUsed
     */
    public function setLastUsed(string $lastUsed): void
    {
        $t = new DateTime();
        $this->lastUsed = $t->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }


}
