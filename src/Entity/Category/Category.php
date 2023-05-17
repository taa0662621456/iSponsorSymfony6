<?php

namespace App\Entity\Category;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Featured\Featured;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Project\ProjectInterface;
use App\EntityInterface\Category\CategoryInterface;
use App\EntityInterface\Featured\FeaturedInterface;
use App\Interface\Object\ObjectApiResourceInterface;
use App\EntityInterface\Category\CategoryAttachmentInterface;

#[ORM\Entity]
class Category extends ObjectSuperEntity implements ObjectInterface, ObjectApiResourceInterface, CategoryInterface
{
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ordering', type: 'integer', unique: false, nullable: false, options: ['default' => 1])]
    private int $ordering = 1;

    #[ORM\OneToMany(mappedBy: 'categoryParent', targetEntity: CategoryInterface::class, fetch: 'EXTRA_LAZY')]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $categoryChildren;

    #[ORM\ManyToOne(targetEntity: CategoryInterface::class, cascade: ['persist'], inversedBy: 'categoryChildren')]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $categoryParent;

    #[ORM\OneToMany(mappedBy: 'projectCategory', targetEntity: ProjectInterface::class)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $categoryProject;

    #[ORM\OneToOne(mappedBy: 'categoryEnGbCategory', targetEntity: CategoryEnGb::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private CategoryEnGb $categoryEnGb;

    #[ORM\OneToMany(mappedBy: 'categoryAttachmentCategory', targetEntity: CategoryAttachmentInterface::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $categoryAttachment;

    #[ORM\OneToOne(mappedBy: 'categoryFeatured', targetEntity: FeaturedInterface::class)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Featured $categoryFeatured;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->categoryChildren = new ArrayCollection();
        $this->categoryProject = new ArrayCollection();
        $this->categoryAttachment = new ArrayCollection();
    }
}
