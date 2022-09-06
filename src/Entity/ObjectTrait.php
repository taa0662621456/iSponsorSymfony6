<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait ObjectTrait
{
    #[ORM\Column(name: 'first_title', type: 'string', nullable: false, options: ['default' => 'first_title'])]
    #[Assert\NotBlank(message: 'object.en.gb.blank')]
    #[Assert\Length(min: 6, minMessage: 'object.en.gb.too.short')]
    private string $firstTitle = 'first_title';

    #[ORM\Column(name: 'middle_title', type: 'text', nullable: false, options: ['default' => 'middle_title'])]
    #[Assert\NotBlank(message: 'object.en.gb.blank')]
    #[Assert\Length(min: 10, minMessage: 'object.en.gb.too.short')]
    private string $middleTitle = 'middle_title';

    #[ORM\Column(name: 'last_title', type: 'text', nullable: false, options: ['default' => 'last_title'])]
    #[Assert\NotBlank(message: 'object.en.gb.blank')]
    #[Assert\Length(min: 6, minMessage: 'object.en.gb.too.short')]
    private string $lastTitle = 'last_title';

    public function getFirstTitle(): string
    {
        return $this->firstTitle;
    }
    public function setFirstTitle(string $firstTitle): void
    {
        $this->firstTitle = $firstTitle;
    }
    #
    public function getMiddleTitle(): string
    {
        return $this->middleTitle;
    }
    public function setMiddleTitle(string $middleTitle): void
    {
        $this->middleTitle = $middleTitle;
    }
    #
    public function getLastTitle(): string
    {
        return $this->lastTitle;
    }
    public function setLastTitle(string $lastTitle): void
    {
        $this->lastTitle = $lastTitle;
    }

}
