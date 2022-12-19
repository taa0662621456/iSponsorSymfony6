<?php


namespace App\Requirement;

final class Requirement
{
    public function __construct(private string $label, private bool $fulfilled, private bool $required = true, private ?string $help = null)
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
