<?php

namespace App\DTO\Category;

use App\DTO\Abstraction\ObjectDTO;
use App\DTO\Featured\FeaturedDTO;
use App\Entity\Featured\Featured;
use App\Interface\Object\ObjectApiResourceInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;

final class CategoryDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private int $ordering = 1;

    private CategoryDTO $categoryChildrenDTO;

    private CategoryDTO $categoryParentDTO;

    private CategoryDTO $categoryProjectDTO;

    #[Assert\Type(type: CategoryEnGbDTO::class)]
    #[Assert\Valid]
    #[Ignore]
    private CategoryEnGbDTO $categoryEnGbDTO;

    private Collection $categoryAttachmentDTO;

    #[Assert\Type(type: CategoryFeaturedDTO::class)]
    #[Assert\Valid]
    #[Ignore]
    private FeaturedDTO $categoryFeaturedDTO;



}
