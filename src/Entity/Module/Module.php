<?php

namespace App\Entity\Module;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'modules')]
#[ORM\Entity]
class Module
{
    use BaseTrait;

    #[ORM\Column(name: 'asset_id', type: 'integer', nullable: false, options: ['comment' => 'FK to the #__assets table.'])]
    private int $assetId;

    #[ORM\Column(name: 'title', type: 'string', nullable: false, options: ['default' => "''"])]
    private string $title = '';

    #[ORM\Column(name: 'note', type: 'string', nullable: false, options: ['default' => "''"])]
    private string $note = '';

    #[ORM\Column(name: 'content', type: 'text', nullable: false, options: ['default' => "''"])]
    private string $content = '';

    #[ORM\Column(name: 'ordering', type: 'integer', nullable: false)]
    private int $ordering = 0;

    #[ORM\Column(name: 'position', type: 'string', nullable: false, options: ['default' => "''"])]
    private string $position = '';

    #[ORM\Column(name: 'checked_out', type: 'integer', nullable: false)]
    private int $checkedOut = 0;

    #[ORM\Column(name: 'checked_out_time', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $checkedOutTime = '';

    #[ORM\Column(name: 'publish_up', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $publishUp = '';

    #[ORM\Column(name: 'publish_down', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $publishDown = '';

    #[ORM\Column(name: 'module', type: 'string', nullable: true, options: ['default' => 0])]
    private ?string $module = '0';

    #[ORM\Column(name: 'access', type: 'integer', nullable: false)]
    private int $access = 0;

    #[ORM\Column(name: 'show_title', type: 'boolean', nullable: false, options: ['default' => 1])]
    private bool $showTitle = true;

    #[ORM\Column(name: 'params', type: 'string', nullable: false)]
    private string $params;

    #[ORM\Column(name: 'client_id', type: 'boolean', nullable: false)]
    private int|bool $clientId = 0;

    #[ORM\Column(name: 'language', type: 'string', nullable: false)]
    private string $language;
}
