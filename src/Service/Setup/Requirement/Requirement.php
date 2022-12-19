<?php

namespace App\Service\Setup\Requirement;

final class Requirement
{
    public function __construct(private readonly string $label, private readonly bool $fulfilled, private readonly bool $required = true, private readonly ?string $help = null)
    {
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function isFulfilled(): bool
    {
        return $this->fulfilled;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function getHelp(): ?string
    {
        return $this->help;
    }
}
