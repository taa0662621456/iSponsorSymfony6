<?php

	namespace App\Entity;

	use App\Doctrine\UuidEncoder;
    use App\Entity\Vendor\Vendors;
    use App\Service\RequestDispatcher;
    use \DateTime;
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
         * @var boolean
         *
         * @ORM\Column(name="published", type="boolean", nullable=false)
         */
        private $published = true;

        /**
         *
         */
        private $attachments;

        /**
         * @var string
         *
         * @ORM\Column(name="slug", type="string", unique=true, nullable=false)
         */
        protected $slug = 'slug';

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
        /**
         * @var RequestDispatcher
         */
        private $requestDispatcher;

        public function __construct(RequestDispatcher $requestDispatcher)
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
            $this->requestDispatcher = $requestDispatcher;
        }

		/**
		 * @return int
		 */
		public function getId(): ?int
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
         * @return bool|false
         */
        public function isPublished(): bool
        {
            return $this->published;
        }

        /**
         * @param bool $published
         */
        public function setPublished(bool $published): void
        {
            $this->published = $published;
        }

        /**
         * @return mixed
         */
        public function getAttachments()
        {
            return $this->attachments;
        }

        public function setAttachments(): void
        {
            $object = $this->requestDispatcher->object();
            $object = new $object;
            $this->attachments = $object;
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

		public function isAuthor(Vendors $vendor = null)
		{
			return $vendor && $vendor->getId() == $this->getCreatedBy();
		}
	}
