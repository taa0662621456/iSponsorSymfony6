<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait ObjectTitleTrait
{
    #[ORM\Column(name: 'first_title', type: 'string', nullable: true, options: ['default' => 'first_title'])]
    protected ?string $firstTitle;

    #[ORM\Column(name: 'middle_title', type: 'text', nullable: true, options: ['default' => 'middle_title'])]
    protected ?string $middleTitle;

    #[ORM\Column(name: 'last_title', type: 'text', nullable: true, options: ['default' => 'last_title'])]
    protected ?string $lastTitle;

    /**
     * @return string
     */
    public function getFirstTitle(): string
    {
        return $this->firstTitle;
    }

    /**
     * @param string|null $firstTitle
     */
    public function setFirstTitle(?string $firstTitle): void
    {
        $this->firstTitle = $firstTitle;
    }

    /**
     * @return string
     */
    public function getMiddleTitle(): string
    {
        return $this->middleTitle;
    }

    /**
     * @param string|null $middleTitle
     */
    public function setMiddleTitle(?string $middleTitle): void
    {
        $this->middleTitle = $middleTitle;
    }

    /**
     * @return string
     */
    public function getLastTitle(): string
    {
        return $this->lastTitle;
    }

    /**
     * @param string|null $lastTitle
     */
    public function setLastTitle(?string $lastTitle): void
    {
        $this->lastTitle = $lastTitle;
    }


}