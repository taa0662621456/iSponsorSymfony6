<?php

namespace App\DTO\Project;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use Doctrine\Common\Collections\Collection;

final class ProjectTagDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private Collection $projectTagProject;
}
