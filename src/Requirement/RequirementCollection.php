<?php


namespace App\Requirement;

use ArrayIterator;
use IteratorAggregate;

abstract class RequirementCollection implements IteratorAggregate
{
    /** @var array|Requirement[] */
    protected array $requirements = [];

    public function __construct(protected string $label)
    {
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->requirements);
    }

    public function add(Requirement $requirement): self
    {
        $this->requirements[] = $requirement;

        return $this;
    }
}
