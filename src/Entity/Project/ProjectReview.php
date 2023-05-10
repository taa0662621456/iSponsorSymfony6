<?php

namespace App\Entity\Project;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Project\ProjectReviewInterface;
use App\Repository\Review\ProjectReviewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'project_review')]
#[ORM\Index(columns: ['slug'], name: 'project_review_idx')]
#[ORM\Entity(repositoryClass: ProjectReviewRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class ProjectReview extends ObjectSuperEntity implements ObjectInterface, ProjectReviewInterface
{
    public const NUM_ROWS = 10;

    #[ORM\Column(name: 'project_id', nullable: true)]
    private ?string $projectReviewId = null;

    public function getProjectReviewId(): ?string
    {
        return $this->projectReviewId;
    }

    public function setProjectReviewId(?string $projectReviewId): void
    {
        $this->projectReviewId = $projectReviewId;
    }

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'projectReview')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Project $projectReviewProject;

    // ManyToOne
    public function getProjectReviewProject(): Project
    {
        return $this->projectReviewProject;
    }

    public function setProjectReviewProject(Project $project): void
    {
        $this->projectReviewProject = $project;
    }

    public function getProjectReviewUuid(): ?string
    {
        // TODO: Implement getProjectReviewUuid() method.
        return '';
    }

    public function setProjectReviewUuid(?string $projectReviewUuid): void
    {
        // TODO: Implement setProjectReviewUuid() method.
    }

    public function getProjectReviewSlug(): ?string
    {
        // TODO: Implement getProjectReviewSlug() method.
        return '';
    }

    public function setProjectReviewSlug(?string $projectReviewSlug): void
    {
        // TODO: Implement setProjectReviewSlug() method.
    }
}
