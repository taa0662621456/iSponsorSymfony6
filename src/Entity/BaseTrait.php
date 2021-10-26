<?php

	namespace App\Entity;

    use App\Entity\Vendor\Vendors;
    use App\Service\RequestDispatcher;
    use DateTime;
    use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Uid\Uuid;
    use Exception;


    trait BaseTrait
    {
        /**
         * @var integer|null
         * @ORM\Id
		 * @ORM\Column(type="integer")
		 * @ORM\GeneratedValue
         * Groups({"object:list", "object:item"})
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private ?int $id = 0;

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
         * @var string
         *
         * @ORM\Column(name="created_at", type="string", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
         */
        private string $createdAt;

        /**
         * @var integer
         *
         * @ORM\Column(name="created_by", type="integer", nullable=false, options={"default" : 1})
         */
        private int $createdBy = 1;

        /**
         * @var string
         *
         * @ORM\Column(name="modified_at", type="string", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
         */
        private string $modifiedAt;

        /**
         * @var integer
         *
         * @ORM\Column(name="modified_by", type="integer", nullable=false, options={"default" : 1})
         */
        private int $modifiedBy = 1;

        /**
         * @var string
         *
         * @ORM\Column(name="locked_at", type="string", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
         */
        private string $lockedAt;

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

        /**
         * @throws Exception
         */
        public function __construct()
        {
            try {
                $this->slug = $this->uuid = Uuid::v4();
            } catch (Exception $e) {
                throw($e);
            }

            $t = new DateTime();
            $this->createdAt = $t->format('Y-m-d H:i:s');
            $this->modifiedAt = $t->format('Y-m-d H:i:s');
            $this->lockedAt = $t->format('Y-m-d H:i:s');
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
         * @return bool
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
         * @return string
         */
        public function getCreatedAt(): string
        {
            return $this->createdAt;
        }

        /**
         * @ORM\PrePersist
         * @throws Exception
         */
        public function setCreatedAt(): void
        {
            $t = new DateTime();
            $this->createdAt = $t->format('Y-m-d H:i:s');
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
         * @return string
         */
        public function getModifiedAt(): string
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
            $t = new DateTime();
            $this->modifiedAt = $t->format('Y-m-d H:i:s');
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
         * @return string
         */
        public function getLockedAt(): string
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
            $t = new DateTime();
            $this->lockedAt = $t->format('Y-m-d H:i:s');
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
