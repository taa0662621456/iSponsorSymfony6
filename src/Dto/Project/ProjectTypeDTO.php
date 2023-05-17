<?php

namespace App\Dto\Project;

use App\Dto\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use Doctrine\Common\Collections\Collection;

final class ProjectTypeDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private Collection $projectTypeProjectDTO;
}
