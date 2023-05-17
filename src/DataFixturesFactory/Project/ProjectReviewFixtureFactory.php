<?php

namespace App\DataFixturesFactory\Project;

use App\DataFixturesFactoryInterface\Project\ProjectReviewDataFixturesFactoryInterface;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\Object\ObjectFactory;

class ProjectReviewFixtureFactory extends ObjectFactory implements ProjectReviewDataFixturesFactoryInterface
{
    private ObjectFactoryInterface $objectFactory;

    public function __construct(ObjectFactoryInterface $objectFactory)
    {
        parent::__construct();
        $this->objectFactory = $objectFactory;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->objectFactory->create(__CLASS__, $options);
    }

    public function getProjectReviewId(): ?string
    {
        // TODO: Implement getProjectReviewId() method.
    }

    public function setProjectReviewId(?string $projectReviewId): void
    {
        // TODO: Implement setProjectReviewId() method.
    }

    public function getProjectReviewUuid(): ?string
    {
        // TODO: Implement getProjectReviewUuid() method.
    }

    public function setProjectReviewUuid(?string $projectReviewUuid): void
    {
        // TODO: Implement setProjectReviewUuid() method.
    }

    public function getProjectReviewSlug(): ?string
    {
        // TODO: Implement getProjectReviewSlug() method.
    }

    public function setProjectReviewSlug(?string $projectReviewSlug): void
    {
        // TODO: Implement setProjectReviewSlug() method.
    }
}
