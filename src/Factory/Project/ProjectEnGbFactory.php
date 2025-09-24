<?php

namespace App\Factory\Project;

use App\Entity\Project\Project;
use App\Entity\Project\ProjectEnGb;

class ProjectEnGbFactory
{
    public function __invoke(): Project
    {
        return new Project();
    }


    public static function createProjectEntity(string $firstTitle, string $lastTitle): ProjectEnGB
    {

        $project = new ProjectEnGB();
        $project->setProjectTitle($firstTitle);
        #
        $project->setFirstTitle($firstTitle);
        $project->setLastTitle($lastTitle);

        return $project;
    }


    public static function createEmptyProjectEnGbEntity(): ProjectEnGB
    {
        return new ProjectEnGB();
    }

}