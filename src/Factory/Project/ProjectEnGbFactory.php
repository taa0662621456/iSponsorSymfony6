<?php

namespace App\Factory\Project;

use App\Service\Object\ObjectFactory;

class ProjectEnGbFactory extends ObjectFactory
{
    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->create(__CLASS__, $options);
    }

}
