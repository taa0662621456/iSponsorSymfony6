<?php

namespace App\Interface;

use App\Entity\Project\Project;

interface TypeInterface
{
    public function getType(): Project;

    public function setType(Project $type): void;

}
