<?php

	namespace App\Entity;

	use \DateTime;
	use Doctrine\ORM\Mapping as ORM;
	use Exception;
	use Ramsey\Uuid\Uuid;
	use Ramsey\Uuid\UuidInterface;
	use Symfony\Component\Validator\Constraints as Assert;

	trait EntitySystemTrait
	{
		/**
		 * @var int
		 *
		 * @ORM\Id
		 * @ORM\Column(type="integer")
		 * @ORM\GeneratedValue
		 */
		private $id;

		/**
		 * @var UuidInterface
		 *
		 * @ORM\Column(type="uuid", unique=true)
		 */
		private $uuid;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="slug", type="string", unique=true, nullable=false, options={"default" = ""})
		 */
		private $slug = '';

		/**
		 * @var DateTime
		 *
		 * @Assert\DateTime
		 * @ORM\Column(name="created_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
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
		 * @Assert\DateTime
		 * @ORM\Column(name="modified_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
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
		 * @Assert\DateTime
		 * @ORM\Column(name="locked_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
		 */
		private $lockedOn;

		/**
		 * @var int
		 *
		 * @ORM\Column(name="locked_by", type="integer", nullable=false, options={"default" : 1})
		 */
		private $lockedBy = 1;

		public function __construct()
		{
			$this->createdOn = new DateTime();
			$this->modifiedOn = new DateTime();
			$this->lockedOn = new DateTime();
			try {
				$this->uuid = Uuid::uuid4();
			} catch (Exception $e) {
			}
			$this->slug = $this->getUuid();

		}

		public function getId(): ?int
		{
			return $this->id;
		}

		public function getUuid(): UuidInterface
		{
			return $this->uuid;
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
		 * @ORM\PrePersist()
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
		 * @param datetime $lockedOn
		 */
		public function setLockedOn(DateTime $lockedOn): void
		{
			$this->lockedOn = $lockedOn;
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
	}
