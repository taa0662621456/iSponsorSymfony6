<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

trait ObjectMetaDTOTrait
{
    private ?string $metaRobot = null;

    private ?string $metaAuthor = null;

    #[Assert\NotBlank(message: 'object.en.gb.blank')]
    #[Assert\Length(min: 6, minMessage: 'object.en.gb.too.short')]
    private string $metaDesc = 'meta_desc';

    #[Assert\NotBlank(message: 'object.en.gb.blank')]
    #[Assert\Length(min: 6, minMessage: 'object.en.gb.too.short')]
    private string $metaKey = 'meta_keywords';

    public function getMetaRobot(): string
    {
        return $this->metaRobot;
    }

    public function setMetaRobot(string $metaRobot): void
    {
        $this->metaRobot = $metaRobot;
    }

    public function getMetaAuthor(): string
    {
        return $this->metaAuthor;
    }

    public function setMetaAuthor(string $metaAuthor): void
    {
        $this->metaAuthor = $metaAuthor;
    }

    public function getMetaDesc(): string
    {
        return $this->metaDesc;
    }

    public function setMetaDesc(string $metaDesc): void
    {
        $this->metaDesc = $metaDesc;
    }

    public function getMetaKey(): string
    {
        return $this->metaKey;
    }

    public function setMetaKey(string $metaKey): void
    {
        $this->metaKey = $metaKey;
    }

}
