<?php

namespace App\Dto\Module;

use App\Dto\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

final class ModuleDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private int $assetIdDTO;

    private string $title = '';

    private string $note = '';

    private string $content = '';

    private int $ordering = 0;

    private string $position = '';

    private int $checkedOut = 0;

    private string $checkedOutTime = '';

    private string $publishUp = '';

    private string $publishDown = '';

    private ?string $module = null;

    private int $access = 0;

    private bool $showTitle = true;

    private string $paramsDTO;

    private int|bool $clientId = 0;

    private string $languageDTO;
}
