<?php

namespace App\Entity\Module;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\CodeNameFilterTrait;
use App\Api\Filter\ModuleMenuFilterTrait;
use App\Api\Filter\RoleFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Symfony\Component\Uid\Uuid;


#[ORM\Table(name: 'module')]
#[ORM\Entity]
#
#[ApiResource(
    operations: [
        new GetCollection(
            paginationEnabled: false,
            order: ['createdAt' => 'DESC'],
            normalizationContext: ['groups' => ['read','list']],
            denormalizationContext: ['groups' => ['write']]
        ),
        new Get(
            normalizationContext: ['groups' => ['read','item']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Put(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Delete(),
        new Get(
            uriTemplate: '/{_entity}/show/{slug}',
            controller: ObjectCRUDsController::class,
            normalizationContext: ['groups' => ['read','item']],
            name: 'get_by_slug'
        )
    ]
)]
class Module
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use ModuleMenuFilterTrait;
    use TimestampFilterTrait;
    use CodeNameFilterTrait;

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

    #[ORM\Column(name: 'module')]
    private ?string $module = null;

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

    public function __construct()
    {
        $t = new \DateTimeImmutable();
        $this->slug = (string)Uuid::v4();

        $this->lastRequestAt = $t;
        $this->createdAt = $t;
        $this->modifiedAt = $t;
        $this->lockedAt = $t;
        $this->published = true;
    }
}
