<?php

namespace App\DTO\Project;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Entity\Category\Category;
use App\Entity\Featured\Featured;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;


final class ProjectDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    public const NUM_ITEMS = 10;

    #[Assert\Type(type: 'App\Entity\Project\ProjectType')]
    #[Assert\Valid]
    private ProjectType $projectType;

    #[Assert\Valid]
    private Category $projectCategory;

    #[Assert\Type(type: 'App\Entity\Project\ProjectEnGb')]
    #[Assert\Valid]
    #[Ignore]
    private ProjectEnGb $projectEnGb;

    #[Assert\Count(max: 8, maxMessage: 'project.too_many_files')]
    #[Assert\Valid]
    private Collection $projectAttachment;

    private Collection $projectFavourite;

    #[Assert\Type(type: 'App\Entity\Project\projectFeatured')]
    #[Assert\Valid]
    #[Ignore]
    private Featured $projectFeatured;

    #[Assert\Count(max: 4, maxMessage: 'project.too_many_tags')]
    private Collection $projectTag;

    #[Assert\Count(max: 100, maxMessage: 'project.too_many_files')]
    private Collection $projectProduct;

    #[Assert\Count(max: 100, maxMessage: 'project.too_many_rewards')]

    private Collection $projectReview;
}
