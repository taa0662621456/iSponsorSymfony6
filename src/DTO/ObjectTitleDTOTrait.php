<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

trait ObjectTitleDTOTrait
{
    #[Assert\NotBlank(message: 'object.en.gb.blank')]
    #[Assert\Length(min: 6, minMessage: 'object.en.gb.too.short')]
    protected string $firstTitle = 'first_title';

    #[Assert\NotBlank(message: 'object.en.gb.blank')]
    #[Assert\Length(min: 10, minMessage: 'object.en.gb.too.short')]
    protected string $middleTitle = 'middle_title';

    #[Assert\NotBlank(message: 'object.en.gb.blank')]
    #[Assert\Length(min: 6, minMessage: 'object.en.gb.too.short')]
    protected string $lastTitle = 'last_title';

    public function getFirstTitle(): string
    {
        return $this->firstTitle;
    }

    public function setFirstTitle(string $firstTitle): void
    {
        $this->firstTitle = $firstTitle;
    }

    public function getMiddleTitle(): string
    {
        return $this->middleTitle;
    }

    public function setMiddleTitle(string $middleTitle): void
    {
        $this->middleTitle = $middleTitle;
    }

    public function getLastTitle(): string
    {
        return $this->lastTitle;
    }

    public function setLastTitle(string $lastTitle): void
    {
        $this->lastTitle = $lastTitle;
    }
}
