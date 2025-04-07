<?php

namespace App\Entity\Project;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Project\ProjectReviewInterface;

#[ORM\Entity]
class ProjectReview extends RootEntity implements ObjectInterface, ProjectReviewInterface
{
    public const NUM_ROWS = 10;

    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\Column(name: 'project_id', nullable: true)]
    private ?string $projectReviewId = null;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'projectReview')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Project $projectReviewProject;
}
