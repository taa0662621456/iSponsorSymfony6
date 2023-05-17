<?php

namespace App\Entity\Project;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Project\ProjectReviewInterface;

#[ORM\Entity]
class ProjectReview extends ObjectSuperEntity implements ObjectInterface, ProjectReviewInterface
{
    public const NUM_ROWS = 10;

    #[ORM\Column(name: 'project_id', nullable: true)]
    private ?string $projectReviewId = null;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'projectReview')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Project $projectReviewProject;
}
