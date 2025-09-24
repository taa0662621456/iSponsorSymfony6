<?php


namespace App\Requirement;

final class IsponsorRequirement implements \IteratorAggregate
{
    /** @var array|RequirementCollection[] */
    private array $collections = [];

    /**
     * @param array|RequirementCollection[] $requirementCollections
     */
    public function __construct(array $requirementCollections)
    {
        foreach ($requirementCollections as $requirementCollection) {
            $this->add($requirementCollection);
        }
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->collections);
    }

    public function add(RequirementCollection $collection): void
    {
        $this->collections[] = $collection;
    }
}