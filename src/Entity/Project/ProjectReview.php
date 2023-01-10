<?php


namespace App\Entity\Project;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;


use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\ObjectBaseTrait;
use App\Entity\ObjectTitleTrait;
use App\Entity\ObjectReviewTrait;
use App\Repository\Review\ProjectReviewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'project_review')]
#[ORM\Index(columns: ['slug'], name: 'project_review_idx')]
#[ORM\Entity(repositoryClass: ProjectReviewRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource(
    collectionOperations: ['get' => ['normalization_context' => ['groups' => 'project:list']]],
    itemOperations: ['get' => ['normalization_context' => ['groups' => 'project:item']]],
    order: ['createdAt' => 'DESC'],
    paginationEnabled: true
)]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
#[ApiFilter(SearchFilter::class, properties: [
    "firstTitle" => "partial",
    "lastTitle" => "partial",
])]
class ProjectReview
{
    use ObjectBaseTrait;
    use ObjectTitleTrait;
    use ObjectReviewTrait;
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
