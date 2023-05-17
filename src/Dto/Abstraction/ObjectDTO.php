<?php

namespace App\Dto\Abstraction;

use App\Dto\MetaDTOTrait;
use App\Dto\ObjectBaseDTOTrait;
use App\Dto\ObjectTitleDTOTrait;

class ObjectDTO
{
    use ObjectBaseDTOTrait;
    use ObjectTitleDTOTrait;
    use MetaDTOTrait;

    public function __construct(string $firstTitle, string $middleTitle, string $lastTitle, ?string $metaRobot,
                                ?string $metaAuthor, string $metaDesc, string $metaKey, ?int $id, bool $published,
                                string $slug, string $createdAt, int $createdBy)
    {

        // Abstraction. BaseDTO
        $this->id = $id;
        $this->slug = $slug;
        $this->createdAt = $createdAt;
        $this->createdBy = $createdBy;
        $this->published = $published;
        // TitleDTO
        $this->firstTitle = $firstTitle;
        $this->middleTitle = $middleTitle;
        $this->lastTitle = $lastTitle;
        // MetaDTO
        $this->metaRobot = $metaRobot;
        $this->metaAuthor = $metaAuthor;
        $this->metaDesc = $metaDesc;
        $this->metaKey = $metaKey;
    }
}
