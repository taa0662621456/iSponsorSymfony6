<?php


namespace App\Entity\Project;

use ApiPlatform\Core\Annotation\ApiResource;


use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\Product\Product;
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
#[ORM\Table(name: 'project_review')]
#[ORM\Index(columns: ['slug'], name: 'project_review_idx')]
#[ORM\Entity(repositoryClass: ProjectReviewRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProjectReview
{
    use BaseTrait;
    use ObjectTrait;
    use ReviewTrait;
    public const NUM_ROWS = 10;

    #[ORM\Column(name: 'project_id', nullable: true)]
    private ?string $projectId = null;

    public function getProjectId(): ?string
    {
        return $this->projectId;
    }
    public function setProjectId(?string $projectId): void
    {
        $this->projectId = $projectId;
    }

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'projectReview')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Project $projectReviewProject;
    # ManyToOne
    public function getProjectReviewProject(): Project
    {
        return $this->projectReviewProject;
    }
    public function setProjectReviewProject(Project $project): void
    {
        $this->projectReviewProject = $project;
    }
}
