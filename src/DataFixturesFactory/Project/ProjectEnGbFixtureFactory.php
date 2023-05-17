<?php

namespace App\DataFixturesFactory\Project;

use App\DataFixturesFactoryInterface\Project\ProjectEnGbDataFixturesFactoryInterface;
use App\Interface\Object\ObjectFactoryInterface;
use App\Interface\Project\ProjectEnGbFactoryInterface;
use App\Service\Object\ObjectFactory;

class ProjectEnGbFixtureFactory extends ObjectFactory implements ProjectEnGbDataFixturesFactoryInterface
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

}
