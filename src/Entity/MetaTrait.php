<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Symfony\Component\Validator\Constraints as Assert;

trait MetaTrait
{

    #[ORM\Column(name: 'meta_robot', type: 'string', nullable: true, options: ['default' => 'meta_robot'])]
    private ?string $metaRobot = null;

    #[ORM\Column(name: 'meta_author', nullable: true)]
    private ?string $metaAuthor = null;

    #[ORM\Column(name: 'meta_desc', type: 'text', nullable: false, options: ['default' => 'meta_desc'])]
    #[Assert\NotBlank(message: 'object.en.gb.blank')]
    #[Assert\Length(min: 6, minMessage: 'object.en.gb.too.short')]
    private string $metaDesc = 'meta_desc';

    #[ORM\Column(name: 'meta_keywords', type: 'text', nullable: false, options: ['default' => 'meta_key'])]
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
    #
    public function getMetaAuthor(): string
    {
        return $this->metaAuthor;
    }
    public function setMetaAuthor(string $metaAuthor): void
    {
        $this->metaAuthor = $metaAuthor;
    }
    #
    public function getMetaDesc(): string
    {
        return $this->metaDesc;
    }
    public function setMetaDesc(string $metaDesc): void
    {
        $this->metaDesc = $metaDesc;
    }
    #
    public function getMetaKey(): string
    {
        return $this->metaKey;
    }
    public function setMetaKey(string $metaKey): void
    {
        $this->metaKey = $metaKey;
    }

}