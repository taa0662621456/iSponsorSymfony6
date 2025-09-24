<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait ObjectMetaDataTrait
{
    #[ORM\Column(name: 'meta_robot', type: 'string', nullable: true, options: ['default' => 'meta_robot'])]
    private ?string $metaRobot = null;

    #[ORM\Column(name: 'meta_author', nullable: true)]
    private ?string $metaAuthor = null;

    #[ORM\Column(name: 'meta_desc', type: 'text', nullable: false, options: ['default' => 'meta_desc'])]
    private string $metaDesc = 'meta_desc';

    #[ORM\Column(name: 'meta_keywords', type: 'text', nullable: false, options: ['default' => 'meta_key'])]
    private string $metaKey = 'meta_keywords';
}