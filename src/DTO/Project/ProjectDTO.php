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
    private ProjectType $projectTypeDTO;

    #[Assert\Valid]
    private Category $projectCategoryDTO;

    #[Assert\Type(type: 'App\Entity\Project\ProjectEnGb')]
    #[Assert\Valid]
    #[Ignore]
    private ProjectEnGb $projectEnGbDTO;

    #[Assert\Count(max: 8, maxMessage: 'project.too_many_files')]
    #[Assert\Valid]
    private Collection $projectAttachmentDTO;

    private Collection $projectFavouriteDTO;

    #[Assert\Type(type: 'App\Entity\Project\projectFeatured')]
    #[Assert\Valid]
    #[Ignore]
    private Featured $projectFeaturedDTO;

    #[Assert\Count(max: 4, maxMessage: 'project.too_many_tags')]
    private Collection $projectTagDTO;

    #[Assert\Count(max: 100, maxMessage: 'project.too_many_files')]
    private Collection $projectProductDTO;

    #[Assert\Count(max: 100, maxMessage: 'project.too_many_rewards')]

    private Collection $projectReviewDTO;
}
