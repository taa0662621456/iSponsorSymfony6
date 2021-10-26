<?php
	declare(strict_types=1);
	namespace App\Entity\Project;

    use App\Entity\BaseTrait;
    use App\Entity\ObjectEntity;
    use App\Entity\Product\Products;
    use Doctrine\ORM\Mapping as ORM;
    use App\Entity\Category\Categories;
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\Common\Collections\Collection;
    use JetBrains\PhpStorm\Pure;
    use Symfony\Component\Validator\Constraints as Assert;



    /**
	 * @ORM\Table(name="projects", indexes={
	 * @ORM\Index(name="project_idx", columns={"slug"})})
	 * UniqueEntity("slug"),
	 *        errorPath="slug",
	 *        message="This slug is already in use!"
	 * @ORM\Entity(repositoryClass="App\Repository\Project\ProjectsRepository")
	 * @ORM\HasLifecycleCallbacks()
	 */
	class Projects
	{
        use BaseTrait;
        public const NUM_ITEMS = 10;

		/**
		 * @var string|null
		 * @ORM\Column(name="project_type", type="string", nullable=true)
		 */
		private ?string $projectType; //TODO: поменять на связь с таблицей типов проектов

		/**
		 * @ORM\ManyToOne(targetEntity="App\Entity\Category\Categories",
		 *      inversedBy="categoryProjects",
		 *      fetch="EXTRA_LAZY")
		 * @ORM\JoinColumn(name="projectCategory_id", referencedColumnName="id")
		 */
		private $projectCategory;

		/**
		 * @ORM\OneToOne(targetEntity="App\Entity\Project\ProjectsEnGb",
		 *     cascade={"persist", "remove"},
		 *     mappedBy="projectEnGb",
		 *     orphanRemoval=true)
		 * @ORM\JoinColumn(name="projectEnGb_id", referencedColumnName="id", onDelete="CASCADE")
		 * @Assert\Type(type="App\Entity\Project\ProjectsEnGb")
		 * @Assert\Valid()
		 */
		private $projectEnGb;


		/**
		 * @var ProjectsAttachments[]|ArrayCollection
		 *
		 * @ORM\OneToMany(targetEntity="App\Entity\Project\ProjectsAttachments",
		 *      cascade={"persist", "remove"},
		 *      mappedBy="projectAttachments",
		 *      orphanRemoval=true)
		 * @ORM\JoinTable(name="project_attachments")
		 * @Assert\Count(max="8", maxMessage="projects.too_many_files")
		 */
		private $projectAttachments;

		/**
		 * @ORM\ManyToMany(targetEntity="App\Entity\Project\ProjectsFavourites", mappedBy="projectFavourites")
		 * @ORM\JoinTable(name="project_favourites")
		 **/
		private $projectFavourites;

		/**
		 * @ORM\OneToOne(targetEntity="App\Entity\Featured",
		 *     cascade={"persist", "remove"},
		 *     mappedBy="projectFeatured"
		 * )
		 */
		private $projectFeatured;

        /**
         * @var ProjectsTags[]|ArrayCollection
         *
         * @ORM\ManyToMany(targetEntity="App\Entity\Project\ProjectsTags", cascade={"persist"})
         * @ORM\JoinTable(name="project_tags")
         * @ORM\OrderBy({"name": "ASC"})
         * @Assert\Count(max="4", maxMessage="projects.too_many_tags")
         *
         */
        private $projectTags;

        /**
         * @var Products[]|ArrayCollection
         *
         * @ORM\OneToMany(targetEntity="App\Entity\Product\Products",
         *      cascade={"persist"},
         *      mappedBy="products",
         *      orphanRemoval=true)
         * @ORM\JoinTable(name="project_products")
         * @Assert\Count(max="100", maxMessage="projects.too_many_files")
         */
        private $projectProducts;

        /**
         * @var ProjectsPlatformReward[]|ArrayCollection
         *
         * @ORM\OneToMany(targetEntity="ProjectsPlatformReward",
         *     cascade={"persist", "remove"},
         *     mappedBy="projectId",
         *     orphanRemoval=true)
         * @ORM\JoinTable(name="rewards")
         * @Assert\Count(max="100", maxMessage="project.too_many_rewards")
         */
        private $projectsPlatformReward;


        /**
         * Projects constructor.
         * @throws \Exception
         */
        #[Pure]
        public function __construct()
        {
            $this->projectAttachments = new ArrayCollection();
            $this->projectTags = new ArrayCollection();
            $this->projectProducts = new ArrayCollection();
            $this->projectsPlatformReward = new ArrayCollection();
        }

		/**
		 * @return mixed
		 */
		public function getProjectCategory()
		{
			return $this->projectCategory;
		}

		/**
		 * @param Categories $projectCategory
		 */
		public function setProjectCategory(Categories $projectCategory): void
		{
			$this->projectCategory = $projectCategory;
		}

		/**
		 * @return string|null
		 */
		public function getProjectType(): ?string
		{
			return $this->projectType;
		}

		/**
		 * @param string|null $projectType
		 */
		public function setProjectType(?string $projectType): void
		{
			$this->projectType = $projectType;
		}

		/**
		 * @param ProjectsTags $tags
		 */
		public function addProjectTag(ProjectsTags $tags): void
		{
			foreach ($tags as $tag) {
				if (!$this->projectTags->contains($tag)) {
					$this->projectTags->add($tag);
				}
			}
		}

		/**
		 * @param ProjectsTags $tag
		 */
		public function removeProjectTag(ProjectsTags $tag): void
		{
			$this->projectTags->removeElement($tag);
		}

		/**
		 * @return Collection|ProjectsTags[]
		 */
		public function getProjectTags(): Collection
		{
			return $this->projectTags;
		}

		/**
		 * @param ProjectsAttachments $attachments
		 */
		public function addProjectAttachment(ProjectsAttachments $attachments): void
		{
			foreach ($attachments as $attachment) {
				if (!$this->projectAttachments->contains($attachment)) {
					$this->projectAttachments->add($attachment);
				}
			}
		}

		/**
		 * @param ProjectsAttachments $attachment
		 */
		public function removeProjectAttachment(ProjectsAttachments $attachment): void
		{
            $this->projectAttachments->removeElement($attachment);
        }

        /**
         * @return Collection|ProjectsAttachments[]
         */
        public function getProjectAttachments(): Collection
        {
            return $this->projectAttachments;
        }

        /**
         * @param Products $products
         */
        public function addProjectProducts(Products $products): void
        {
            foreach ($products as $product) {
                if (!$this->projectProducts->contains($product)) {
                    $this->projectProducts->add($product);
                }
            }
        }

        /**
         * @param Products $product
         */
        public function removeProjectProducts(Products $product): void
        {
            $this->projectProducts->removeElement($product);
        }

        /**
         * @return Collection|Products[]
         */
        public function getProjectProducts(): Collection
        {
            return $this->projectProducts;
        }

        /**
         * @param ProjectsPlatformReward $rewards
         */
        public function addProjectPlatformReward(ProjectsPlatformReward $rewards): void
        {
            foreach ($rewards as $reward) {
                if (!$this->projectsPlatformReward->contains($reward)) {
                    $this->projectsPlatformReward->add($reward);
                }
            }
        }

        /**
         * @param ProjectsPlatformReward $reward
         */
        public function removeProjectPlatformReward(ProjectsPlatformReward $reward): void
        {
            $this->projectsPlatformReward->removeElement($reward);
        }

        /**
         * @return Collection|ProjectsPlatformReward[]
         */
        public function getProjectPlatformRewards(): Collection
        {
            return $this->projectsPlatformReward;
        }

        /**
         * @return mixed
         */
        public function getProjectEnGb(): mixed
        {
            return $this->projectEnGb;
        }

        /**
		 * @param ProjectsEnGb $projectEnGb
		 */
		public function setProjectEnGb(ProjectsEnGb $projectEnGb): void
		{
			$this->projectEnGb = $projectEnGb;
		}

		/**
		 * @return int
		 */
		public function getProjectFavourites(): int
		{
			return $this->projectFavourites;
		}

		/**
		 * @param int $projectFavourites
		 */
		public function setProjectFavourites(int $projectFavourites): void
		{
			$this->projectFavourites = $projectFavourites;
		}

		/**
		 * @return mixed
		 */
		public function getProjectFeatured(): mixed
        {
			return $this->projectFeatured;
		}

		/**
		 * @param mixed $projectFeatured
		 */
		public function setProjectFeatured($projectFeatured): void
		{
			$this->projectFeatured = $projectFeatured;
		}
	}
