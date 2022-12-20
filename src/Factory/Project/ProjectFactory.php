<?php

namespace App\Factory\Project;

use App\Entity\Project\Project;

class ProjectFactory
{
    public function __invoke(): Project
    {
        return new Project();
    }


    public static function create(): Project
    {
        return new Project();
    }

}
