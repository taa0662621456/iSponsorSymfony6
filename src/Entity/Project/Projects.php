<?php
	declare(strict_types=1);

	namespace App\Entity\Project;

	use App\Entity\Category\Categories;
	use App\Entity\BaseTrait;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\ORM\Mapping as ORM;
	use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
	use Symfony\Component\Validator\Constraints as Assert;


	/**
	 * @ORM\Table(name="projects", indexes={
	 * @ORM\Index(name="project_slug", columns={"slug"})})
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
		private $projectType;

		/**
		 * @var int
		 *
		 * @ORM\Column(name="published", type="integer", nullable=false, options={"default" : 1})
		 */
		private $published = 1;

		/**
		 * @ORM\ManyToOne(targetEntity="App\Entity\Category\Categories",
		 *      cascade={"persist"},
		 *      inversedBy="categoryProjects",
		 *      fetch="EXTRA_LAZY"
		 * )
		 */
		private $projectCategory;

		/**
		 * @ORM\OneToOne(targetEntity="App\Entity\Project\ProjectsEnGb",
		 *      cascade={"persist", "remove"},
		 *      orphanRemoval=true)
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
		 * @var int
		 *
		 * @ORM\ManyToMany(targetEntity="App\Entity\Project\ProjectsFavourites", mappedBy="projectFavourites")
		 * @ORM\JoinTable(name="project_favourites")
		 * @ORM\OrderBy({"name": "ASC"})
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
		 * Projects constructor.
		 */
		public function __construct()
		{
			$this->projectAttachments = new ArrayCollection();
			$this->projectTags = new ArrayCollection();
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
		 * @return int
		 */
		public function getPublished(): int
		{
			return $this->published;
		}

		/**
		 * @param int $published
		 */
		public function setPublished(int $published): void
		{
			$this->published = $published;
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
		 * @return mixed
		 */
		public function getProjectEnGb()
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

	}