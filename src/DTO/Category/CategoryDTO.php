<?php

namespace App\DTO\Category;

use App\DTO\Abstraction\ObjectDTO;
use App\Entity\Featured\Featured;
use App\Interface\Object\ObjectApiResourceInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;

final class CategoryDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private int $ordering = 1;

    private Collection $categoryChildren;

    private Collection $categoryParent;

    private Collection $categoryProject;

    #[Assert\Type(type: CategoryEnGb::class)]
    #[Assert\Valid]
    #[Ignore]
    private CategoryEnGb $categoryEnGb;

    private Collection $categoryAttachment;

    #[Assert\Type(type: CategoryFeatured::class)]
    #[Assert\Valid]
    #[Ignore]
    private Featured $categoryFeatured;



}
