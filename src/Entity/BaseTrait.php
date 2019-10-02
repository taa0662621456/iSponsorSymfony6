<?php

	namespace App\Entity;

	use App\Doctrine\UuidEncoder;
	use \DateTime;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\ORM\Mapping as ORM;
	use Exception;
	use Ramsey\Uuid\Uuid;
	use Ramsey\Uuid\UuidInterface;
	use Symfony\Component\Validator\Constraints as Assert;

	trait BaseTrait
	{
		/**
		 * @var integer
		 *
		 * @ORM\Id
		 * @ORM\Column(type="integer")
		 * @ORM\GeneratedValue
		 */
		private $id;

		/**
		 * @var UuidInterface
		 *
		 * @ORM\Column(type="uuid", unique=true, nullable=false)
		 */
		protected $uuid;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="slug", type="string", unique=true, nullable=false)
		 */
		protected $slug;

		/**
		 * @var DateTime
		 *
		 * @ORM\Column(name="created_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
		 * @Assert\DateTime
		 */
		private $createdOn;

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="created_by", type="integer", nullable=false, options={"default" : 1})
		 */
		private $createdBy = 1;

		/**
		 * @var DateTime
		 *
		 * @ORM\Column(name="modified_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
		 * @Assert\DateTime
		 */
		private $modifiedOn;

		/**
		 * @var integer
		 *
		 * @ORM\Column(name="modified_by", type="integer", nullable=false, options={"default" : 1})
		 */
		private $modifiedBy = 1;

		/**
		 * @var DateTime
		 *
		 * @ORM\Column(name="locked_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
		 * @Assert\DateTime
		 */
		private $lockedOn;

		/**
		 * @var int
		 *
		 * @ORM\Column(name="locked_by", type="integer", nullable=false, options={"default" : 1})
		 */
		private $lockedBy = 1;

		/**
		 * @ORM\Column(type="integer")
		 * @ORM\Version
		 */
		protected $version;

		public function __construct()
		{
			try {
				$this->uuid = Uuid::uuid4();
				$slugEncode = new UuidEncoder();
				$this->slug = $slugEncode->encode($this->uuid);
			} catch (Exception $e) {
			}

			$this->createdOn = new DateTime();
			$this->modifiedOn = new DateTime();
			$this->lockedOn = new DateTime();
		}

		/**
		 * @return int
		 */
		public function getId(): int
		{
			return $this->id;
		}

		/**
		 * @return UuidInterface|null
		 */
		public function getUuid(): ?UuidInterface
		{
			return $this->uuid;
		}

		/**
		 * @param UuidInterface $uuid
		 */
		public function setUuid(UuidInterface $uuid): void
		{
			$this->uuid = $uuid;
		}


		/**
		 * @return string
		 */
		public function getSlug(): string
		{
			return $this->slug;
		}

		/**
		 * @param string $slug
		 */
		public function setSlug(string $slug): void
		{
			$this->slug = $slug;
		}


		/**
		 * @return DateTime
		 */
		public function getCreatedOn(): DateTime
		{
			return $this->createdOn;
		}

		/**
		 * @ORM\PrePersist
		 * @throws Exception
		 */
		public function setCreatedOn(): void
		{
			$this->createdOn = new DateTime();
		}

		/**
		 * @return integer
		 */
		public function getCreatedBy(): int
		{
			return $this->createdBy;
		}

		/**
		 * @param integer $createdBy
		 */
		public function setCreatedBy(int $createdBy): void
		{
			$this->createdBy = $createdBy;
		}

		/**
		 * @return DateTime
		 */
		public function getModifiedOn(): DateTime
		{
			return $this->modifiedOn;
		}

		/**
		 * @ORM\PreFlush
		 * @ORM\PreUpdate
		 * @throws Exception
		 */
		public function setModifiedOn(): void
		{
			$this->modifiedOn = new DateTime();
		}

		/**
		 * @return integer
		 */
		public function getModifiedBy(): int
		{
			return $this->modifiedBy;
		}

		/**
		 * @param integer $modifiedBy
		 */
		public function setModifiedBy(int $modifiedBy): void
		{
			$this->modifiedBy = $modifiedBy;
		}

		/**
		 * @return DateTime
		 */
		public function getLockedOn(): DateTime
		{
			return $this->lockedOn;
		}

		/**
		 * @ORM\PrePersist
		 * @ORM\PreFlush
		 * @ORM\PreUpdate
		 * @throws Exception
		 */
		public function setLockedOn(): void
		{
			$this->lockedOn = new DateTime();
		}


		/**
		 * @return integer
		 */
		public function getLockedBy(): int
		{
			return $this->lockedBy;
		}

		/**
		 * @param integer $lockedBy
		 */
		public function setLockedBy(int $lockedBy): void
		{
			$this->lockedBy = $lockedBy;
		}

		/**
		 * @return mixed
		 */
		public function getVersion()
		{
			return $this->version;
		}

		/**
		 * @param mixed $version
		 */
		public function setVersion($version): void
		{
			$this->version = $version;
		}
	}
