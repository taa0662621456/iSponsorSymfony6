<?php


namespace App\Entity\Review;

use ApiPlatform\Core\Annotation\ApiResource;


use App\Entity\BaseTrait;
use App\Entity\ReviewTrait;
use App\Repository\Review\ProjectReviewRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(collectionOperations={"get"={"normalization_context"={"groups"="project:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="project:item"}}},
 *     order={"createdAt"="DESC"},
 *     paginationEnabled=true
 *     )
 * ApiFilter(properties={"review": "exact"}) //TODO: Чтобы работала аннотация, необходимо создать таблицы базы
 */
#[ORM\Table(name: 'project_reviews')]
#[ORM\Index(columns: ['slug'], name: 'project_reviews_idx')]
#[ORM\Entity(repositoryClass: ProjectReviewRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ReviewProject
{
    use BaseTrait;
    use ReviewTrait;
    public const NUM_ROWS = 10;

    #[ORM\Column(name: 'project_id', type: 'string', nullable: true)]
    private ?string $projectId = null;

    #[ORM\Column(name: 'project_uuid', type: 'string', nullable: true)]
    private ?string $projectUuid = null;

    #[ORM\Column(name: 'project_slug', type: 'string', nullable: true)]
    private ?string $projectSlug = null;
    public function getProjectId(): ?string
    {
        return $this->projectId;
    }
    public function setProjectId(?string $projectId): void
    {
        $this->projectId = $projectId;
    }
    public function getProjectUuid(): ?string
    {
        return $this->projectUuid;
    }
    public function setProjectUuid(?string $projectUuid): void
    {
        $this->projectUuid = $projectUuid;
    }
    public function getProjectSlug(): ?string
    {
        return $this->projectSlug;
    }
    public function setProjectSlug(?string $projectSlug): void
    {
        $this->projectSlug = $projectSlug;
    }
}
