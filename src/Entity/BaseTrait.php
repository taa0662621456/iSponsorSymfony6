<?php

	namespace App\Entity;

    use App\Entity\Vendor\Vendors;
    use App\Service\RequestDispatcher;
    use DateTimeImmutable;
    use DateTimeInterface;
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Uid\Uuid;
    use Exception;
    use Symfony\Component\Validator\Constraints as Assert;

    trait BaseTrait
    {
        /**
         * @var integer
         * @ORM\Id
		 * @ORM\Column(type="integer")
		 * @ORM\GeneratedValue
         * Groups({"object:list", "object:item"})
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private int $id;

        /**
         * @ORM\Column(name="uuid", type="uuid", unique=true, nullable=false)
         */
        protected Uuid $uuid;

        /**
         * @var boolean
         *
         * @ORM\Column(name="published", type="boolean", nullable=false)
         */
        private bool $published = true;

//        /**
//         *
//         */
//        private mixed $attachments;

        /**
         * @var string
         *
         * @ORM\Column(name="slug", type="string", unique=true, nullable=false)
         */
        protected string $slug = 'slug';

        /**
         * @var DateTimeInterface
         *
         * @ORM\Column(name="created_at", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
         * @Assert\DateTime
         */
        private DateTimeInterface $createdAt;

        /**
         * @var integer
         *
         * @ORM\Column(name="created_by", type="integer", nullable=false, options={"default" : 1})
         */
        private int $createdBy = 1;

        /**
         * @var DateTimeInterface
         *
         * @ORM\Column(name="modified_at", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
         * @Assert\DateTime
         */
        private DateTimeInterface $modifiedAt;

        /**
         * @var integer
         *
         * @ORM\Column(name="modified_by", type="integer", nullable=false, options={"default" : 1})
         */
        private int $modifiedBy = 1;

        /**
         * @var DateTimeInterface
         *
         * @ORM\Column(name="locked_at", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
         * @Assert\DateTime
         */
        private DateTimeInterface $lockedAt;

        /**
         * @var int
         *
         * @ORM\Column(name="locked_by", type="integer", nullable=false, options={"default" : 1})
         */
        private int $lockedBy = 1;

        /**
         * @var string
         * @ORM\Column(name="work_flow", type="string", nullable=false,
         *     options={"default"="submitted", "comment"="Submitted, Spam and Published stats"})
         */
        private string $workFlow = 'submitted';

        /**
         * @ORM\Column(type="integer")
         * @ORM\Version
         */
        protected int $version;
        /**
         * @var RequestDispatcher
         */
        private RequestDispatcher $requestDispatcher;

        public function __construct()
        {
            try {
                $this->slug = $this->uuid = Uuid::v4();
//                $slugEncode = new Uuid($this->uuid);
//                $this->slug = $slugEncode->toBase32($this->uuid);
                //$this->requestDispatcher = new RequestDispatcher();
            } catch (Exception $e) {
            }

            $this->createdAt = new DateTimeImmutable();
            $this->modifiedAt = new DateTimeImmutable();
            $this->lockedAt = new DateTimeImmutable();
        }

        /**
         * @return int|null
         */
		public function getId(): ?int
		{
			return $this->id;
		}

        /**
         * @return Uuid
         */
		public function getUuid(): Uuid
		{
			return $this->uuid;
        }

        /**
         * @param $uuid
         */
        public function setUuid($uuid): void
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
        public function getAttachments(): mixed
        {
            return $this->attachments;
        }

        public function setAttachments(RequestDispatcher $requestDispatcher): void
        {
            $object = $requestDispatcher->object();
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
         * @return DateTimeImmutable
         */
        public function getCreatedAt(): DateTimeImmutable
        {
            return $this->createdAt;
        }

        /**
         * @ORM\PrePersist
         * @throws Exception
         */
        public function setCreatedAt(): void
        {
            $this->createdAt = new DateTimeImmutable();
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
         * @return DateTimeInterface
         */
        public function getModifiedAt(): DateTimeInterface
        {
            return $this->modifiedAt;
        }

        /**
         * @ORM\PreFlush
         * @ORM\PreUpdate
         * @throws Exception
         */
        public function setModifiedAt(): void
        {
            $this->modifiedAt = new DateTimeImmutable();
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
         * @return DateTimeInterface
         */
        public function getLockedAt(): DateTimeInterface
        {
            return $this->lockedAt;
        }

        /**
         * @ORM\PrePersist
         * @ORM\PreFlush
         * @ORM\PreUpdate
         * @throws Exception
         */
        public function setLockedAt(): void
        {
            $this->lockedAt = new DateTimeImmutable();
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
         * @return string
         */
        public function getWorkFlow(): string
        {
            return $this->workFlow;
        }

        /**
         * @param string $workFlow
         */
        public function setWorkFlow(string $workFlow): void
        {
            $this->workFlow = $workFlow;
        }


		/**
		 * @return int
		 */
		public function getVersion(): int
		{
			return $this->version;
		}

		/**
		 * @param int $version
		 */
		public function setVersion(int $version): void
		{
			$this->version = $version;
		}

		public function isAuthor(Vendors $vendor = null): bool
        {
			return $vendor && $vendor->getId() == $this->getCreatedBy();
		}
	}
