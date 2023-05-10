<?php

namespace App\DTO\Project;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

final class ProjectFavouriteDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private int $projectFavourite;

}
